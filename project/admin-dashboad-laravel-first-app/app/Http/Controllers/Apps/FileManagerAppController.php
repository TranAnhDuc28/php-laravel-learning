<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class FileManagerAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showFileManager() {
        return view('apps.file_manager.file_manager');
    }
}
