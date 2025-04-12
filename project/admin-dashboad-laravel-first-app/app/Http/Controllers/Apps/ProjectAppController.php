<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class ProjectAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showProjectList() {
        return view('apps.projects.list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showProjectOverview() {
        return view('apps.projects.overview');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCreateProject() {
        return view('apps.projects.create_project');
    }
}
