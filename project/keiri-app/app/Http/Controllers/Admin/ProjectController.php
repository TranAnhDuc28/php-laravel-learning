<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectStatus;
use App\Enums\UserStatus;
use App\Exports\ExportExcelDemo;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Throwable;

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

    /**
     * @return Factory|View|Application|object
     */
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

    /**
     * @return Factory|View|Application|object
     */
    public function processCreateProject(ProjectRequest $request)
    {
        $validated = $request->validated();

        try {
            DB::beginTransaction();
            $project = new Project();
            $project->project_code = $validated['project_code'];
            $project->project_name = $validated['project_name'];
            $project->project_start_date = $validated['project_start_date'];
            $project->project_end_date = $validated['project_end_date'];
            $project->note = $validated['note'] ?? null;
            $project->phase = $validated['phase'] ?? null;
            $project->priority = $validated['priority'] ?? null;
            $project->status = $validated['status'] ?? null;



            DB::commit();
            return redirect()->route('project.showProjectList');
        } catch (Throwable $ex) {
            DB::rollBack();
            Log::error(__METHOD__ . '(): ' . $ex->getMessage());

            return back()->withInput();
        }
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Factory|View|Application|object
     */
    public function showUpdateProjectForm(Request $request, string $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'numeric', 'integer', Rule::exists(Project::class, 'id')],
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $project = Project::find($id);

        $viewData = [
            'project' => $project,
        ];

        return view('pages.project.update_project', $viewData);
    }


    public function showProjectReport()
    {
        return view('pages.project.report.report');
    }

    /**
     * @return BinaryFileResponse
     */
    public function exportReport(Request $request)
    {
        return Excel::download(new ExportExcelDemo(), 'report_' . Carbon::now() . '.xlsx');
    }
}
