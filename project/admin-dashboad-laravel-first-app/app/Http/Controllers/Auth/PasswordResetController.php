<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showPasswordResetBasic()
    {
        return view('auth.password_reset.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showPasswordResetCover()
    {
        return view('auth.password_reset.cover');
    }
}
