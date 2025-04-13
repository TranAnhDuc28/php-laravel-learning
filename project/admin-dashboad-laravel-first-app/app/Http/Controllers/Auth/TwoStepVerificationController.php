<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class TwoStepVerificationController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showTwoStepVerificationBasic()
    {
        return view('auth.two_step_verification.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTwoStepVerificationCover()
    {
        return view('auth.two_step_verification.cover');
    }
}
