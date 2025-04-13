<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class SuccessMsgController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showSuccessMessageBasic()
    {
        return view('auth.success_msg.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showSuccessMessageCover()
    {
        return view('auth.success_msg.cover');
    }
}
