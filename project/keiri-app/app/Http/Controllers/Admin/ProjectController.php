<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectStatus;
use App\Enums\UserStatus;
use App\Exports\ExportExcelDemo;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProjectController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showProjectList()
    {
        $projects = Project::all();

        $viewData = [
            'projects' => $projects,
        ];

        return view('pages.project.project_list', $viewData);
    }

    public function showCreateProjectForm()
    {
        $projects = Project::query()->select('id', 'project_code', 'project_name')
            ->whereNot('status', value: ProjectStatus::COMPLETED)->get();

        $users = User::query()->select('id', 'full_name')
            ->whereNot('status', value: UserStatus::ACTIVE)->get();

        $viewData = [
            'projects' => $projects,
            'users' => $users,
        ];

        return view('pages.project.project_create', $viewData);
    }

    public function showProjectAssignment()
    {
        return view('pages.project.project_assignment');
    }

    public function showProjectReport()
    {
        return view('pages.project.report');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportReport(Request $request)
    {
        return Excel::download(new ExportExcelDemo(), 'report_' . Carbon::now() . '.xlsx');
    }
}
