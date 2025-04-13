<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class EChartUIController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showECharts()
    {
        return view('charts.echarts');
    }
}
