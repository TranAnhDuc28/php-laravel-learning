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
        return view('pages.report.monthly_payment_request');
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
        $year = $request->input('year');

        /* Create range date. */
        $startDate = Carbon::create($year, $startMonth)->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::create($year, $endMonth)->endOfMonth()->format('Y-m-d');

        /* Generate a list of months for the tab list. */
        $period = CarbonPeriod::create($startDate, '1 month', $endDate);
        $monthReports = [];
        foreach ($period as $date) {
            $monthReports[] = $date->format('d/m/Y');
        }

        /* Get projects join of members. */
        $users = User::with([
            'projects' => function ($query) use ($startDate, $endDate) {
                $query->select('projects.id', 'project_name', 'project_start_date', 'project_end_date', 'projects.status')
                    ->where(function ($query) use ($startDate, $endDate) {
                        $query->whereBetween('project_start_date', [$startDate, $endDate])
                            ->orWhereBetween('project_end_date', [$startDate, $endDate])
                            ->orWhere(function ($query) use ($startDate, $endDate) {
                                $query->where('project_start_date', '<=', $startDate)
                                    ->where('project_end_date', '>=', $endDate);
                            });
                    })
                    ->withPivot('id', 'status');
            }
        ])
            ->select('users.id', 'full_name', 'job_position', 'employee_costs')
            ->get();

        /* Get log project assign detail of member. */
        $projectAssignIds = $users->pluck('projects')->flatten()->pluck('pivot.id')->toArray();
        $projectAssignLogs = ProjectAssignmentLog::query()
            ->whereIn('id', $projectAssignIds)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('project_join_date', [$startDate, $endDate])
                    ->orWhereBetween('project_exit_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('project_join_date', '<=', $startDate)
                            ->where('project_exit_date', '>=', $endDate);
                    });
            })->get();

        /* Prepare report data. */
        $reportData = [];
        foreach ($period as $monthDate) {
            $monthStart = $monthDate->startOfMonth();
            $monthEnd = $monthDate->endOfMonth();
            $monthKey = $monthDate->format('d/m/Y');

            $monthData = [];
            foreach ($users as $user) {
                // Lọc các assignment có log trong khoảng thời gian báo cáo
                $activeAssignments = $user->projects->filter(function ($project) use ($monthStart, $monthEnd, $projectAssignLogs) {
                    $isActivePeriod = $project->project_start_date->lte($monthEnd) && ($project->project_end_date ?: $monthEnd)->gte($monthStart);
                    $logs = collect($projectAssignLogs->get($project->pivot->id, []));
                    $hasLogsInPeriod = $logs->filter(function ($log) use ($monthStart, $monthEnd) {
                        if (!$log instanceof \App\Models\ProjectAssignmentLog) {
                            return false; // Bỏ qua nếu không phải model
                        }

                        $logStart = Carbon::parse($log->project_join_date);
                        $logEnd = $log->project_exit_date ? Carbon::parse($log->project_exit_date) : $monthEnd;
                        return $logStart->lte($monthEnd) && $logEnd->gte($monthStart);
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
                foreach ($activeAssignments as $project) {
                    $logs = $projectAssignLogs[$project->pivot->id] ?? collect();
                    $projectWorkedDays = 0;
                    $projectAmount = 0;

                    foreach ($logs as $log) {
                        $logStart = Carbon::parse($log->project_join_date);
                        $logEnd = $log->project_exit_date ? Carbon::parse($log->project_exit_date) : $monthEnd;

                        $effectiveStart = $logStart->max($monthStart);
                        $effectiveEnd = $logEnd->min($monthEnd);

                        $workedDaysInPeriod = DateUtil::workingDaysBetween(
                            $effectiveStart->format('Y-m-d'),
                            $effectiveEnd->format('Y-m-d')
                        );

                        // Điều chỉnh số ngày làm việc dựa trên effort_percentage.
                        $adjustedWorkedDays = $workedDaysInPeriod * ($log->effort_percentage / 100);
                        $projectWorkedDays += $adjustedWorkedDays;

                        // Tính amount cho khoảng thời gian này
                        $unitPrice = $user->employee_costs; // Sử dụng employee_costs từ DB
                        $totalDaysInMonth = DateUtil::workingDaysBetween($monthStart->format('Y-m-d'), $monthEnd->format('Y-m-d'));
                        if ($totalDaysInMonth > 0) {
                            $proratedFactor = $adjustedWorkedDays / $totalDaysInMonth;
                            $projectAmount += $unitPrice * $proratedFactor;
                        }
                    }

                    $totalAmount += $projectAmount;

                    // Lưu thông tin chi tiết của assignment.
                    $projectDetails[] = [
                        'name' => $project->project_name,
                        'project_status' => $projectStatusMap[$project->status] ?? '',
                        'assignment_status' => $assignmentStatusMap[$project->pivot->status] ?? '',
                        'worked_days' => round($projectWorkedDays, 2),
                        'amount' => round($projectAmount, 2),
                    ];
                }

                // Prepare job content (tên các project).
                $jobContent = $activeAssignments->pluck('project_name')->toArray();

                // Prepare employee data for this month.
                $monthData[] = [
                    'employee_name' => $user->full_name,
                    'rank' => $user->role,
                    'contract_unit_price' => $user->employee_costs,
                    'job_content' => $jobContent,
                    'projects' => $projectDetails,
                    'monthly_data' => [
                        'regular_overtime' => 0,
                        'overtime_work' => 0,
                        'total' => round($totalAmount, 2),
                    ],
                ];
            }

            $reportData[$monthKey] = $monthData;
        }

        dd(
            $users->toArray(),
            $reportData,
            $monthReports
        );

        $viewData = [
            'reportData' => $reportData,
            'monthReports' => $monthReports,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];

        return view('pages.report.monthly_payment_request', $viewData);
    }
}

