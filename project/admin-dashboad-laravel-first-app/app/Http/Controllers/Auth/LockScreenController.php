<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class LockScreenController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showLockScreenBasic()
    {
        return view('auth.lock_screen.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showLockScreenCover()
    {
        return view('auth.lock_screen.cover');
    }
}
