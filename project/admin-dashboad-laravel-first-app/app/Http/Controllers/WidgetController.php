<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class WidgetController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showWidgets()
    {
        return view('widgets');
    }
}
