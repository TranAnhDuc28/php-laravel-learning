<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showSignInBasic()
    {
        return view('auth.sign_in.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSignInCover()
    {
        return view('auth.sign_in.cover');
    }
}
