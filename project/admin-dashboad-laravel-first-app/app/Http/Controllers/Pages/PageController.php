<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showStarterPage() {
        return view('pages.starter');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTeamPage() {
        return view('pages.team');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTimelinePage() {
        return view('pages.timeline');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showFrequentlyAskedQuestionsPage() {
        return view('pages.frequently_asked_questions');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showPricingPage() {
        return view('pages.pricing');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showGalleryPage() {
        return view('pages.gallery');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showMaintenancePage() {
        return view('pages.maintenance');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showComingSoonPage() {
        return view('pages.coming_soon');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSitemapPage() {
        return view('pages.sitemap');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSearchResultPage() {
        return view('pages.search_result.search_results');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showPrivacyPolicyPage() {
        return view('pages.privacy_policy');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTermAndConditionsPage() {
        return view('pages.term_condition');
    }
}
