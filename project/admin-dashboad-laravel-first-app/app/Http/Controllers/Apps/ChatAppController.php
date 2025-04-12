<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ChatAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showChat() {
        return view('apps.chat.chat');
    }
}
