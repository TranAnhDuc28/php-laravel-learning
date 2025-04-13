<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class AdvanceUIController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showSweetAlerts()
    {
        return view('advance_ui.sweet_alerts');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showNestableList()
    {
        return view('advance_ui.nestable_list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showScrollbar()
    {
        return view('advance_ui.scrollbar');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showAnimation()
    {
        return view('advance_ui.animation');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTour()
    {
        return view('advance_ui.tour');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSwiperSlider()
    {
        return view('advance_ui.swiper_slider');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showRatings()
    {
        return view('advance_ui.ratings');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showHighlight()
    {
        return view('advance_ui.highlight');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showScrollSpy()
    {
        return view('advance_ui.scroll_spy');
    }
}
