<?php

namespace App\Http\Controllers;

use App\Exports\ExportExcelTest;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class TestController extends Controller
{
    /**
     * @return BinaryFileResponse
     */
    public function exportTest()
    {
        return Excel::download(new ExportExcelTest(), 'test_' . Carbon::now() . '.xlsx');
    }
}
