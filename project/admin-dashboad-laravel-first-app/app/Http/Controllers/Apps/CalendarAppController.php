<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CalendarAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showMainCalendar() {
        return view('apps.calendar.main_calendar');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCalendarMonthGrid() {
        return view('apps.calendar.month_grid');
    }
}
