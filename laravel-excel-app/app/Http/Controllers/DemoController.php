<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcelDemo;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DemoController extends Controller
{
    /**
     * @return BinaryFileResponse
     */
    public function exportDemo()
    {
        return Excel::download(new ExportExcelDemo(), 'test_' . Carbon::now() . '.xlsx');
    }
}
