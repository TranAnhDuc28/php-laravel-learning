<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CrmDashboardController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showCrmDashboard() {
        return view('dashboards.customer_relationship_management.index');
    }
}
