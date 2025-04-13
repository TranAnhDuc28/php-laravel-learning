<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showSignUpBasic()
    {
        return view('auth.sign_up.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSignUpCover()
    {
        return view('auth.sign_up.cover');
    }
}
