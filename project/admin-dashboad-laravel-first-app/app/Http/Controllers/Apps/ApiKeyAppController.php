<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ApiKeyAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showApiKey() {
        return view('apps.api_key.api_key');
    }
}
