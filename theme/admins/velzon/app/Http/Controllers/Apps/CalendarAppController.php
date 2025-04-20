<?php

namespace App\Http\Controllers\Apps;

use App\Dto\EventDto;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CalendarAppController extends Controller
{
    /**
     * Show main calendar view with initial events
     * @return Factory|View|Application|object
     */
    public function showMainCalendar() {
        $initialEvents = $this->getFormattedEvents();

        return view('apps.calendar.main_calendar', [
            'initialEvents' => $initialEvents
        ]);
    }

    /**
     * Get events via API
     * @return JsonResponse
     */
    public function listEvents(): JsonResponse
    {
        $events = $this->getFormattedEvents();
        return response()->json($events);
    }

    /**
     * Show calendar month grid view
     * @return Factory|View|Application|object
     */
    public function showCalendarMonthGrid() {
        return view('apps.calendar.month_grid');
    }

    /**
     * Create new event
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after:start',
            'allDay' => 'boolean',
            'className' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $event = Event::create($validated);
        return response()->json(EventDto::fromArray($event->toArray()));
    }

    /**
     * Update existing event
     * @param Request $request
     * @param Event $event
     * @return JsonResponse
     */
    public function update(Request $request, Event $event): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date|after:start',
            'allDay' => 'boolean',
            'className' => 'nullable|string',
            'location' => 'nullable|string',
            'description' => 'nullable|string'
        ]);

        $event->update($validated);
        return response()->json(EventDto::fromArray($event->toArray()));
    }

    /**
     * Delete an event
     * @param Event $event
     * @return JsonResponse
     */
    public function destroy(Event $event): JsonResponse
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }

    /**
     * Get formatted events
     * @return array
     */
    private function getFormattedEvents(): array
    {
        $rawEvents = Event::all()->toArray();
        $formattedEvents = [];
        
        foreach ($rawEvents as $rawEvent) {
            $formattedEvents[] = EventDto::fromArray($rawEvent);
        }

        return $formattedEvents;
    }
} 