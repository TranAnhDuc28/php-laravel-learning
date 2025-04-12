<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ToDoAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showToDo() {
        return view('apps.to_do.to_do');
    }
}
