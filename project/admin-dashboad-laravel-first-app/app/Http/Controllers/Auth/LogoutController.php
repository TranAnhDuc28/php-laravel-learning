<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showLogoutBasic()
    {
        return view('auth.logout.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showLogoutCover()
    {
        return view('auth.logout.cover');
    }
}
