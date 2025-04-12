<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class TaskAppController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showKanbanBoard() {
        return view('apps.tasks.kanban_board');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTaskList() {
        return view('apps.tasks.tasks_list');
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showTaskDetails() {
        return view('apps.tasks.task_details');
    }
}
