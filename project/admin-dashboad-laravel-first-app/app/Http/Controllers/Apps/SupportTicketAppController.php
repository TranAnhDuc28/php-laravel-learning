<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class SupportTicketAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showList() {
        return view('apps.support_tickets.ticket_list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTicketDetails() {
        return view('apps.support_tickets.ticket_details');
    }
}
