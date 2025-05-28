<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportExcelMonthlyPaymentRequest;
use App\Http\Controllers\Controller;
use App\Models\ProjectAssignmentLog;
use App\Models\User;
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

        // Create range date.
        $startDate = Carbon::create($year, $startMonth)->startOfMonth()->format('Y-m-d');
        $endDate = Carbon::create($year, $endMonth)->endOfMonth()->format('Y-m-d');

        // Generate a list of months for the table headers.
        $period = CarbonPeriod::create($startDate, '1 month', $endDate);
        $monthReports = [];
        foreach ($period as $date) {
            $monthReports[] = $date->format('d/m/Y');
        }

        /* Get projects join of members. */
        $users = User::with([
            'projects' => function ($query) use ($startDate, $endDate) {
                $query->select('projects.id', 'project_name', 'project_start_date', 'project_end_date')
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
        $projectAssignIds = [];
        foreach ($users as $user) {
            foreach ($user->projects as $project) {
                $projectAssignIds[] = $project->pivot->id;
            }
        }

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

        // Prepare data for the view.
        $reportData = [];
        foreach ($users as $user) {
            $employeeData = [
                'employee_name' => $user->full_name,
                'rank' => $user->job_position,
                'contract_unit_price' => $user->employee_costs,
                'job_content' => [],
                'monthly_data' => [],
            ];

            // Map projects to job content.
            foreach ($user->projects as $project) {
                $employeeData['job_content'][] = $project->project_name;
            }

            // Calculate monthly data (unit price, overtime, totals).
            foreach ($period as $monthDate) {
                $monthStart = $monthDate->startOfMonth();
                $monthEnd = $monthDate->endOfMonth();
                $monthKey = $monthDate->format('d/m/Y');

                // Find relevant logs for this month.
                $relevantLogs = $projectAssignLogs->filter(function ($log) use ($monthStart, $monthEnd) {
                    $joinDate = $log->project_join_date ?? $monthStart;
                    $exitDate = $log->project_exit_date ?? $monthEnd;
                    return $joinDate <= $monthEnd && $exitDate >= $monthStart;
                });

                $overtimeWork = $relevantLogs->sum('worked_days');
                $regularOvertime = 200;

                // Total = (1) + (2) * (3)
                $total = $user->employee_costs + ($regularOvertime * $overtimeWork);

                $employeeData['monthly_data'][$monthKey] = [
                    'regular_overtime' => $regularOvertime,
                    'overtime_work' => $overtimeWork,
                    'total' => $total,
                ];
            }

            $reportData[] = $employeeData;
        }

        dd($users->toArray(), $projectAssignIds, $projectAssignLogs->toArray(), $reportData);


        $viewData = [
            'reportData' => $reportData,
            'monthReports' => $monthReports,
        ];

        return view('pages.report.monthly_payment_request', $viewData);
    }
}

