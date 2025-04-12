<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CrmAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showCrmContacts() {
        return view('apps.crm.contacts');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCrmCompanies() {
        return view('apps.crm.companies');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCrmDeals() {
        return view('apps.crm.deals');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCrmLeads() {
        return view('apps.crm.leads');
    }
}
