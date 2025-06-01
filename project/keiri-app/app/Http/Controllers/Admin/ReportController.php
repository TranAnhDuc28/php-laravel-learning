<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectStatus;
use App\Exports\ExportExcelMonthlyPaymentRequest;
use App\Http\Controllers\Controller;
use App\Models\ProjectAssignmentLog;
use App\Models\User;
use App\Utils\DateUtil;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showMonthlyPaymentRequest()
    {
        $defaultEndMonth = Carbon::now()->month;
        $defaultYear = Carbon::now()->year;

        $endDate = Carbon::create($defaultYear, $defaultEndMonth)->endOfMonth()->format('d/m/Y');

        $monthReports[] = $endDate;
        $startMonth = null;
        $endMonth = null;

        $viewData = [
            'monthReports' => $monthReports,
            'dataReports' => [],
            'startMonth' => $startMonth,
            'endMonth' => $endMonth,
            'year' => $defaultYear,
        ];
        return view('pages.report.monthly_payment_request', $viewData);
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showProjectPaymentRequest()
    {
        return view('pages.report.project_payment_request');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportReport(Request $request)
    {
        return Excel::download(new ExportExcelMonthlyPaymentRequest(), 'report_' . Carbon::now() . '.xlsx');
    }

    /**
     * @param Request $request
     * @return Application|Factory|object|View
     */
    public function generateDataMonthlyPaymentRequest(Request $request)
    {
        // Validate request data.
        $validator = Validator::make($request->all(), [
            'start_month' => ['required', 'integer', 'between:1,12'],
            'end_month' => ['nullable', 'integer', 'between:1,12', 'gte:start_month'],
            'year' => ['required', 'integer', 'min:2000', 'max:2100'],
        ]);

        if ($validator->fails()) {
            return back()->withInput();
        }

        $startMonth = $request->input('start_month');
        $endMonth = $request->input('end_month') ?? $startMonth;
        $year = $request->input('year', Carbon::now()->year);

        /* Create range date. */
        $startDate = Carbon::create($year, $startMonth)->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::create($year, $endMonth)->endOfMonth()->format('Y-m-d');

        /* Generate a list of months for the tab list. */
        $period = CarbonPeriod::create($startDate, '1 month', $endDate);

        /* Title tab report. */
        $monthReports = [];
        foreach ($period as $date) {
            $monthReports[] = $date->copy()->endOfMonth()->format('d/m/Y');
        }

        /* Get projects join of members. */
        $users = User::with([
            'projects' => function ($query) use ($startDate, $endDate) {
                $query->select('projects.id', 'project_name', 'project_start_date', 'project_end_date', 'projects.status')
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('project_start_date', [$startDate, $endDate])
                            ->orWhereBetween('project_end_date', [$startDate, $endDate])
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                $query->where('project_start_date', '<=', $startDate)->where('project_end_date', '>=', $endDate);
                            })
                            ->orWhere(function ($query) use ($startDate) {
                                $query->where('project_start_date', '<=', $startDate)->whereNull('project_end_date');
                            });
                    })->withPivot('id', 'status', 'note');
            }
        ])->select('users.id', 'full_name', 'job_position', 'employee_costs')->get();

        /* Get log project assign detail of member. */
        $projectAssignIds = $users->pluck('projects')->flatten()->pluck('pivot.id')->toArray();
        $projectAssignLogs = ProjectAssignmentLog::query()
            ->whereIn('project_assignment_id', $projectAssignIds)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('project_join_date', [$startDate, $endDate])
                    ->orWhereBetween('project_exit_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('project_join_date', '<=', $startDate)->where('project_exit_date', '>=', $endDate);
                    })
                    ->orWhere(function ($query) use ($startDate) {
                        $query->where('project_join_date', '<=', $startDate)->whereNull('project_exit_date');
                    });
            })->get()->groupBy('project_assignment_id');

        /* Prepare report data. */
        $dataReports = [];
        foreach ($period as $date) {
            $monthStartDate = $date->copy()->startOfMonth();
            $monthEndDate = $date->copy()->endOfMonth();
            $monthKey = $monthEndDate->copy()->format('d/m/Y');

            // Tính tổng số ngày làm việc trong tháng báo cáo.
            $totalDaysInMonth = DateUtil::workingDaysBetween($monthStartDate, $monthEndDate);

            $monthData = [];
            foreach ($users as $user) {
                // Filter assignments that have logs within the reporting period.
                $activeAssignments = $user->projects->filter(function ($project) use ($monthStartDate, $monthEndDate, $projectAssignLogs) {
                    // Check if the project is active during the reporting period.
                    $isActivePeriod = $project->project_start_date->lte($monthEndDate) && ($project->project_end_date ?: $monthEndDate)->gte($monthStartDate);

                    $logs = collect($projectAssignLogs->get($project->pivot->id, collect()));
                    $hasLogsInPeriod = $logs->filter(function ($log) use ($monthStartDate, $monthEndDate) {
                        $logStartDate = Carbon::parse($log->project_join_date);
                        $logEndDate = $log->project_exit_date ? Carbon::parse($log->project_exit_date) : $monthEndDate;
                        return $logStartDate->lte($monthEndDate) && $logEndDate->gte($monthStartDate);
                    })->isNotEmpty();
                    return $isActivePeriod && $hasLogsInPeriod;
                });

                // Skip if no active assignments.
                if ($activeAssignments->isEmpty()) {
                    continue;
                }

                // Calculate worked days and amount.
                $totalAmount = 0;
                $projectDetails = [];
                $monthlyDetails = [];
                foreach ($activeAssignments as $project) {
                    $logs = $projectAssignLogs[$project->pivot->id] ?? collect();
                    $projectWorkedDays = 0; // Number of working days in the project.
                    $projectAmount = 0; // That person's cost for this project.
                    $projectAssignLogDetails = [];

                    foreach ($logs as $log) {
                        $logStartDate = Carbon::parse($log->project_join_date);
                        $logEndDate = $log->project_exit_date ? Carbon::parse($log->project_exit_date) : $monthEndDate;

                        $effectiveStart = $logStartDate->max($monthStartDate);
                        $effectiveEnd = $logEndDate->min($monthEndDate);

                        // Cộng dồn số ngày làm việc thực tế cho khoảng thời gian tham gia dự án này.
                        $workedDaysInPeriod = DateUtil::workingDaysBetween($effectiveStart, $effectiveEnd);
                        $projectWorkedDays += $workedDaysInPeriod;

                        // Calculate amount for this period based on prorated days and effort percentage
                        $unitPrice = $user->employee_costs;
                        if ($totalDaysInMonth > 0) {
                            $proratedFactor = $workedDaysInPeriod / $totalDaysInMonth;
                            $baseAmount = $unitPrice * $proratedFactor;
                            $adjustedAmount = $baseAmount * ($log->effort_percentage / 100);
                        } else {
                            $adjustedAmount = 0;
                        }

                        $projectAmount += $adjustedAmount;

                        // Lưu chi tiết projectAssignLog vào mảng logDetails
                        $projectAssignLogDetails[] = [
                            'start_date' => $logStartDate->format('Y-m-d'),
                            'end_date' => $effectiveEnd->format('Y-m-d'),
                            'effort_percentage' => $log->effort_percentage,
                            'worked_days' => $workedDaysInPeriod,
                        ];

                        // Lưu chi tiết chi phí vào mảng monthlyDetails
                        $monthlyDetails[] = [
                            'project_name' => $project->project_name,
                            'amount' => round($adjustedAmount, 2),
                        ];
                    }

                    $totalAmount += $projectAmount;

                    // Lưu thông tin chi tiết của assignment.
                    $projectDetails[] = [
                        'project_name' => $project->project_name,
                        'project_status' => $project->status->value,
                        'assignment_status' => $project->pivot->status->value,
                        'project_assign_log_details' => $projectAssignLogDetails,
                        'total_worked_days' => round($projectWorkedDays, 2),
                        'total_amount' => round($projectAmount, 2),
                    ];
                }

                // Prepare job content (tên các project).
                $jobContent = $activeAssignments->pluck('project_name')->toArray();

                // Prepare employee data for this month.
                $monthData[] = [
                    'employee_name' => $user->full_name,
                    'rank' => $user->job_position,
                    'contract_unit_price' => +$user->employee_costs,
                    'job_content' => $jobContent,
                    'projects' => $projectDetails,
                    'monthly_data' => [
                        'details' => $monthlyDetails,
                        'regular_overtime' => 0,
                        'overtime_work' => 0,
                        'total' => round($totalAmount, 2),
                    ],
                ];
            }

            $dataReports[$monthKey] = $monthData;
        }

//        dd($dataReports);

        $viewData = [
            'monthReports' => $monthReports,
            'dataReports' => $dataReports,
            'startMonth' => $startMonth,
            'endMonth' => $endMonth,
            'year' => $year,
        ];

        return view('pages.report.monthly_payment_request', $viewData);
    }
}

