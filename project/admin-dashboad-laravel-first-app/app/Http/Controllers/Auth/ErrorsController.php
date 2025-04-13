<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showError400Basic()
    {
        return view('auth.errors.400_basic');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showError400Cover()
    {
        return view('auth.errors.400_cover');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showError400Alt()
    {
        return view('auth.errors.400_alt');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showError500()
    {
        return view('auth.errors.500');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showOfflinePage()
    {
        return view('auth.errors.offline_page');
    }
}
