<?php

namespace App\Http\Controllers\Apps;

use App\Dto\EventDto;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;

class CalendarAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showMainCalendar() {
        $rawEvents = Event::all()->toArray();
        $formattedEvents = [];
        foreach ($rawEvents as $rawEvent) {
            $formattedEvents[] = EventDto::fromArray($rawEvent);
        }

        $data = [
            'eventList' => $formattedEvents
        ];

        return view('apps.calendar.main_calendar', $data);
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCalendarMonthGrid() {
        return view('apps.calendar.month_grid');
    }
}
