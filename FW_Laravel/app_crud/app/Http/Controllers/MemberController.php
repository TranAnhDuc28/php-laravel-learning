<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function dashboard() {
        return view('member.dashboard');
    }
}
