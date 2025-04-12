<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProjectsDashboardController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showProjectsDashboard() {
        return view('dashboards.projects.index');
    }
}
