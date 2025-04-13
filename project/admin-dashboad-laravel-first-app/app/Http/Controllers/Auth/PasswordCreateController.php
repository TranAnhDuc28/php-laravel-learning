<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class PasswordCreateController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showPasswordCreateBasic()
    {
        return view('auth.password_create.basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showPasswordCreateCover()
    {
        return view('auth.password_create.cover');
    }
}
