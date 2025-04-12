<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CryptoDashboardController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showCryptoDashboard() {
        return view('dashboards.crypto.index');
    }
}
