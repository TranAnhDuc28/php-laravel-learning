<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class NftDashboardController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showNftDashboard() {
        return view('dashboards.non_fungible_token.index');
    }
}
