<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcelDemo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    /**
     * @return BinaryFileResponse
     */
    public function exportReport(Request $request)
    {
        return Excel::download(new ExportExcelDemo(), 'report_' . Carbon::now() . '.xlsx');
    }
}
