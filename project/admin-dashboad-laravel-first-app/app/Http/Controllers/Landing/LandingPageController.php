<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showLandingPage() {
        return view('landing.one_page');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showNFTLandingPage() {
        return view('landing.nft');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showJobLandingPage() {
        return view('landing.job');
    }
}
