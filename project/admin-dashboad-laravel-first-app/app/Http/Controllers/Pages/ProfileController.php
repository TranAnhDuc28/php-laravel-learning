<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ProfileController extends PageController
{
    /**
     * @return Factory|View|Application|object
     */
    public function showProfileSimplePage() {
        return view('pages.profile.simple_page');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showProfileSettings() {
        return view('pages.profile.settings');
    }
}
