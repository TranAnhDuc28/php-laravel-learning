<?php

namespace App\Listeners;

use App\Events\EventTest1;
use App\Events\EventTest2;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Log;

class EventSubscriber
{
    /**
* Handle user login events.
*/
    public function handleEventTest1(EventTest1 $event): void {
        Log::debug(__METHOD__ . ' - ' . __FUNCTION__);
    }

    /**
     * Handle user logout events.
     */
    public function handleEventTest2(EventTest2 $event): void {
        Log::debug(__METHOD__ . ' - ' . __FUNCTION__);
    }

    /**
     * Register the listeners for the subscriber.
     */
    public function subscribe(Dispatcher $events): array
    {
        return [
            EventTest1::class => 'handleEventTest1',
            EventTest2::class => 'handleEventTest2',
        ];
    }
}
