<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class TimekeepingController extends Controller
{
    public function showPageTimekeepingData()
    {
        return view('pages.timekeeping.timekeeping_data');
    }

    public function showPageDetailedTimesheet()
    {
        return view('pages.timekeeping.detail_timesheet');
    }

    public function showPageGeneralTimesheet()
    {
        return view('pages.timekeeping.general_timesheet');
    }
}
