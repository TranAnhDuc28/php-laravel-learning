<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AssignmentStatus;
use App\Enums\UserStatus;
use App\Exports\ExportExcelMonthlyPaymentRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectAssignment;
use App\Models\ProjectAssignmentLog;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
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
    public function showCreateProject()
    {
//        $projects = Project::query()->select('id', 'project_code', 'project_name')
//            ->whereNot('status', value: ProjectStatus::COMPLETED)->get();

        $users = User::query()->select('id', 'full_name')
            ->where('status', UserStatus::ACTIVE)->get();

        $viewData = [
//            'projects' => $projects,
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
        $projectStartDate = Carbon::parse($validated['project_start_date'])->format('Y-m-d');

        try {
            DB::beginTransaction();
            $project = new Project();
            $project->project_code = $validated['project_code'];
            $project->project_name = $validated['project_name'];
            $project->project_start_date = $projectStartDate;
            $project->project_end_date = $validated['project_end_date'];
            $project->phase = $validated['phase'] ?? null;
            $project->priority = $validated['priority'] ?? null;
            $project->status = $validated['status'] ?? null;
            $project->note = $validated['note'] ?? null;
            $project->save();

            if (!empty($validated['team_members'])) {
                foreach ($validated['team_members'] as $teamMember) {
                    $projectAssignment = new ProjectAssignment();
                    $projectAssignment->user_id = (int)$teamMember;
                    $projectAssignment->project_id = $project->id;
                    $projectAssignment->status = AssignmentStatus::ACTIVE;
                    $projectAssignment->save();

                    $projectAssignmentLog = new ProjectAssignmentLog();
                    $projectAssignmentLog->project_id = $project->id;
                    $projectAssignmentLog->user_id = (int)$teamMember;
                    $projectAssignmentLog->project_assignment_id = $projectAssignment->id;
                    $projectAssignmentLog->project_join_date = $projectStartDate;
                    $projectAssignmentLog->save();
                }
            }

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
     * @param $id
     * @return Factory|View|Application|object
     */
    public function showUpdateProject(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'numeric', 'integer', Rule::exists(Project::class, 'id')],
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $users = User::query()->select('id', 'full_name')
            ->where('status', UserStatus::ACTIVE)->get();

        $project = Project::with([
            'users' => function ($query) {
                $query->select('users.id')->wherePivot('status', AssignmentStatus::ACTIVE);
            }])->find($id);

//        dd($project);

        $viewData = [
            'project' => $project,
            'users' => $users,
        ];

        return view('pages.project.project_update', $viewData);
    }

    /**
     * @return Factory|View|Application|object
     */
    public function processUpdateProject(ProjectRequest $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'numeric', 'integer', Rule::exists(Project::class, 'id')],
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $project = Project::with([
            'users' => function ($query) {
                $query->select('users.id')->withPivot('id', 'status', 'note');
            }])->find($id);

        $validated = $request->validated();

        try {
            DB::beginTransaction();
            $project->project_code = $validated['project_code'];
            $project->project_name = $validated['project_name'];
            $project->project_start_date = $validated['project_start_date'];
            $project->project_end_date = $validated['project_end_date'];
            $project->phase = $validated['phase'] ?? null;
            $project->priority = $validated['priority'] ?? null;
            $project->status = $validated['status'] ?? null;
            $project->note = $validated['note'] ?? null;
            $project->save();

            /* Get list of old members (including active and inactive). */
            $existingAssignments = ProjectAssignment::where('project_id', $project->id)->get()->keyBy('user_id');

            /* New member list. */
            $newUserIds = !empty($validated['team_members']) ? array_map('intval', $validated['team_members']) : [];

            /* Handle new member list: Add or Reactivate. */
            foreach ($newUserIds as $userId) {
                /* Member joined project. */
                if (isset($existingAssignments[$userId])) {
                    $assignment = $existingAssignments[$userId];
                    /* Change status to active. */
                    if ($assignment->status === AssignmentStatus::INACTIVE) {
                        $assignment->status = AssignmentStatus::ACTIVE;
                        $assignment->save();

//                        $lastLog = $assignment->logs()->latest()->first();
//                        if ($lastLog && $lastLog->project_exit_date !== null
//                            && Carbon::parse($lastLog->project_join_date)->equalTo(Carbon::now())) {
//                            $lastLog->project_exit_date = null;
//                            $lastLog->save();
//                        }
                    }
                    unset($existingAssignments[$userId]);
                } else {
                    /* Create new member for project. */
                    $projectAssignment = new ProjectAssignment();
                    $projectAssignment->user_id = $userId;
                    $projectAssignment->project_id = $project->id;
                    $projectAssignment->status = AssignmentStatus::ACTIVE;
                    $projectAssignment->save();

                    $projectAssignmentLog = new ProjectAssignmentLog();
                    $projectAssignmentLog->project_id = $project->id;
                    $projectAssignmentLog->user_id = $userId;
                    $projectAssignmentLog->project_assignment_id = $projectAssignment->id;
                    $projectAssignmentLog->project_join_date = $project->project_start_date;
                    $projectAssignmentLog->save();
                }
            }

            /* Remove the remaining members of existingAssignments from the project, change status to inactive. */
            foreach ($existingAssignments as $assignment) {
                if ($assignment->status === AssignmentStatus::ACTIVE) {
                    $assignment->status = AssignmentStatus::INACTIVE;
                    $assignment->save();
                }
            }

            DB::commit();
            return redirect()->route('project.showProjectList');
        } catch (Throwable $ex) {
            DB::rollBack();
            Log::error(__METHOD__ . '(): ' . $ex->getMessage());

            return back()->withInput();
        }
    }


}
