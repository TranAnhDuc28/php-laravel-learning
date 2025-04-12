<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class EcommerceDashboardController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showEcommerceDashboard() {
        return view('dashboards.ecommerce.index');
    }
}
