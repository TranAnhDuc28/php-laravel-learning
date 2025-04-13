<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ChartJsUIController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showChartsJS()
    {
        return view('charts.chartjs');
    }
}
