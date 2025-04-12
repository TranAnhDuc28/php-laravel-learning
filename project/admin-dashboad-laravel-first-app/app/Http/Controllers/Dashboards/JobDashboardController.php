<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class JobDashboardController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showJobDashboard() {
        return view('dashboards.job.index');
    }
}
