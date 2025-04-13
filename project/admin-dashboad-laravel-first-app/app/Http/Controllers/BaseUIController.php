<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class BaseUIController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showAlerts()
    {
        return view('base_ui.alerts');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showBadges()
    {
        return view('base_ui.badges');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showButtons()
    {
        return view('base_ui.buttons');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showColors()
    {
        return view('base_ui.colors');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCards()
    {
        return view('base_ui.cards');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCarousel()
    {
        return view('base_ui.carousel');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showDropdowns()
    {
        return view('base_ui.dropdowns');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showGrid()
    {
        return view('base_ui.grid');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showImages()
    {
        return view('base_ui.images');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTabs()
    {
        return view('base_ui.tabs');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showAccordions()
    {
        return view('base_ui.accordions');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showModals()
    {
        return view('base_ui.modals');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showOffcanvas()
    {
        return view('base_ui.offcanvas');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showPlaceholders()
    {
        return view('base_ui.placeholders');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showProgress()
    {
        return view('base_ui.progress');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showNotifications()
    {
        return view('base_ui.notifications');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showMediaObject()
    {
        return view('base_ui.media_object');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showEmbedVideo()
    {
        return view('base_ui.embed_video');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTypography()
    {
        return view('base_ui.typography');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showLists()
    {
        return view('base_ui.lists');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showLinks()
    {
        return view('base_ui.links');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showGeneral()
    {
        return view('base_ui.general');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showRibbons()
    {
        return view('base_ui.ribbons');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showUtilities()
    {
        return view('base_ui.utilities');
    }
}
