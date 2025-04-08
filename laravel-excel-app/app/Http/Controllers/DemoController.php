<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcelDemo;
use App\Exports\ExportExcelTest;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DemoController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showViewDemo(Request $request)
    {
        return view('demo');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportDemo(Request $request)
    {
        return Excel::download(new ExportExcelDemo(), 'report_' . Carbon::now() . '.xlsx');
    }
}
