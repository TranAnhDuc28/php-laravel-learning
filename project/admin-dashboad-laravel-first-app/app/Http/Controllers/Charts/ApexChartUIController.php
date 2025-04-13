<?php

namespace App\Http\Controllers\Charts;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ApexChartUIController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showLineChart()
    {
        return view('charts.apexcharts.line');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showAreaChart()
    {
        return view('charts.apexcharts.area');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showColumnChart()
    {
        return view('charts.apexcharts.column');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showBarChart()
    {
        return view('charts.apexcharts.bar');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showMixedChart()
    {
        return view('charts.apexcharts.mixed');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTimelineChart()
    {
        return view('charts.apexcharts.timeline');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showRangeAreaChart()
    {
        return view('charts.apexcharts.range_area');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showFunnelChart()
    {
        return view('charts.apexcharts.funnel');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCandlestickChart()
    {
        return view('charts.apexcharts.candlestick');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showBoxplotChart()
    {
        return view('charts.apexcharts.boxplot');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showBubbleChart()
    {
        return view('charts.apexcharts.bubble');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showScatterChart()
    {
        return view('charts.apexcharts.scatter');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showHeatmapChart()
    {
        return view('charts.apexcharts.heatmap');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTreemapChart()
    {
        return view('charts.apexcharts.treemap');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showPieChart()
    {
        return view('charts.apexcharts.pie');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showRadialbarChart()
    {
        return view('charts.apexcharts.radialbar');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showRadarChart()
    {
        return view('charts.apexcharts.radar');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showPolarAreaChart()
    {
        return view('charts.apexcharts.polar_area');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSlopeChart()
    {
        return view('charts.apexcharts.slope');
    }
}
