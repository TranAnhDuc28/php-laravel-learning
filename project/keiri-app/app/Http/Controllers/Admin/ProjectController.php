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
use App\Utils\DateUtil;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
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
        $projects = Project::query()->orderBy('project_name')->get();

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
        $users = User::query()->select('id', 'full_name')
            ->where('status', UserStatus::ACTIVE)
            ->orderBy('full_name')->get();

        $viewData = [
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
                    $projectAssignment->status = AssignmentStatus::ACTIVE->value;
                    $projectAssignment->save();

                    $projectAssignmentLog = new ProjectAssignmentLog();
                    $projectAssignmentLog->project_id = $project->id;
                    $projectAssignmentLog->user_id = (int)$teamMember;
                    $projectAssignmentLog->project_assignment_id = $projectAssignment->id;
                    $projectAssignmentLog->project_join_date = Carbon::now()->get('Y-m-d');
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
            ->where('status', UserStatus::ACTIVE)
            ->orderBy('full_name')->get();

        $project = Project::with([
            'users' => function ($query) {
                $query->select('users.id')->wherePivot('status', AssignmentStatus::ACTIVE);
            }])->find((int)$id);

        $viewData = [
            'project' => $project,
            'users' => $users,
        ];

        return view('pages.project.project_update', $viewData);
    }

    /**
     * @return RedirectResponse
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
            }])->find((int)$id);

        $validated = $request->validated();
        $projectStartDate = Carbon::parse($validated['project_start_date'])->format('Y-m-d');

        try {
            DB::beginTransaction();
            $project->project_code = $validated['project_code'];
            $project->project_name = $validated['project_name'];
            $project->project_start_date = $projectStartDate;
            $project->project_end_date = $validated['project_end_date'];
            $project->phase = $validated['phase'] ?? null;
            $project->priority = $validated['priority'] ?? null;
            $project->status = $validated['status'] ?? null;
            $project->note = $validated['note'] ?? null;
            $project->save();

            /* Get list of old members (including active and inactive). */
            $existingAssignments = ProjectAssignment::query()
                ->where('project_id', $project->id)
                ->with(['logs' => function ($query) {
                    $query->orderBy('project_join_date', 'DESC');
                }])
                ->get()->keyBy('user_id');

            /* New member list. */
            $newUserIds = !empty($validated['team_members']) ? array_map('intval', $validated['team_members']) : [];

            /* Handle new member list: Add or Reactivate. */
            $currentDate = Carbon::now()->format('Y-m-d');
            foreach ($newUserIds as $userId) {
                /* Member joined project. */
                if (isset($existingAssignments[$userId])) {
                    $assignment = $existingAssignments[$userId];
                    /* Change status to active. */
                    if ($assignment->status === AssignmentStatus::INACTIVE) {
                        $assignment->status = AssignmentStatus::ACTIVE->value;
                        $assignment->save();

                        /* Check log latest */
                        $lastLog = $assignment->logs->first();
                        if ($lastLog && $lastLog->project_exit_date) {
                            $exitDate = $exitDate = Carbon::parse($lastLog->project_exit_date)->format('Y-m-d');
                            if ($exitDate === $currentDate) {
                                $lastLog->project_exit_date = null;
                                $lastLog->worked_days = 0;
                                $lastLog->save();
                            } else {
                                $projectAssignmentLog = new ProjectAssignmentLog();
                                $projectAssignmentLog->project_id = $project->id;
                                $projectAssignmentLog->user_id = $userId;
                                $projectAssignmentLog->project_assignment_id = $assignment->id;
                                $projectAssignmentLog->project_join_date = $currentDate;
                                $projectAssignmentLog->save();
                            }
                        } else {
                            $projectAssignmentLog = new ProjectAssignmentLog();
                            $projectAssignmentLog->project_id = $project->id;
                            $projectAssignmentLog->user_id = $userId;
                            $projectAssignmentLog->project_assignment_id = $assignment->id;
                            $projectAssignmentLog->project_join_date = $currentDate;
                            $projectAssignmentLog->save();
                        }
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
                    $projectAssignmentLog->project_join_date = Carbon::now()->get('Y-m-d');
                    $projectAssignmentLog->save();
                }
            }

            /* Remove the remaining members of existingAssignments from the project, change status to inactive. */
            foreach ($existingAssignments as $assignment) {
                if ($assignment->status === AssignmentStatus::ACTIVE) {
                    $assignment->status = AssignmentStatus::INACTIVE->value;
                    $assignment->save();
                }

                /* Update log for member exit project. */
                $lastLog = $assignment->logs->first();
                if ($lastLog && !$lastLog->project_exit_date) {
                    $lastLog->project_exit_date = $currentDate;
                    $lastLog->worked_days = DateUtil::workingDaysBetween($currentDate, $lastLog->project_exit_date);
                    $lastLog->save();
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
