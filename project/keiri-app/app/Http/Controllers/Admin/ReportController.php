<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportExcelMonthlyPaymentRequest;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showMonthlyPaymentRequest()
    {
        return view('pages.project.report.monthly_payment_request');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showProjectPaymentRequest()
    {
        return view('pages.project.report.project_payment_request');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportReport(Request $request)
    {
        return Excel::download(new ExportExcelMonthlyPaymentRequest(), 'report_' . Carbon::now() . '.xlsx');
    }
}
