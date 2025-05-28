<?php

namespace App\Http\Controllers\Admin;

use App\Enums\AssignmentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectAssignLogRequest;
use App\Models\Project;
use App\Models\ProjectAssignment;
use App\Models\ProjectAssignmentLog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Throwable;

class ProjectAssignmentController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showProjectAssignment()
    {
        $projectAssignments = Project::with([
            'users' => fn($query) => $query->select('users.id', 'users.full_name')
                ->withPivot(['id', 'status', 'note'])
                ->wherePivot('status', AssignmentStatus::ACTIVE),
        ])->select('id', 'project_code', 'project_name')->orderBy('project_name')->get();

        $viewData = [
            'projectAssignments' => $projectAssignments,
        ];

        return view('pages.project.project_assign.project_assignment', $viewData);
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showProjectAssignmentDetail(Request $request, $projectId)
    {
        $validator = Validator::make(['id' => $projectId], [
            'id' => ['required', 'numeric', 'integer', Rule::exists(Project::class, 'id')],
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $projectAssignmentLogs = null;
        $usersWithLogs = null;
        $projectAssignmentDetail = Project::with([
            'users' => function ($query) {
                $query->select('users.id', 'users.full_name')->orderBy('users.full_name')
                    ->withPivot(['id', 'status', 'note']);
            }])->find((int)$projectId);

        // Get list id member assign.
        if ($projectAssignmentDetail) {
            $projectAssignIds = $projectAssignmentDetail->users->pluck('pivot.id')->toArray();
            $projectAssignmentLogs = ProjectAssignmentLog::query()->whereIn('project_assignment_id', $projectAssignIds)->get();

            $usersWithLogs = $projectAssignmentDetail->users->map(function ($user) use ($projectAssignmentLogs) {
                $logs = $projectAssignmentLogs->where('project_assignment_id', $user->pivot->id)->sortByDesc('project_join_date');
                return [
                    'id' => $user->id,
                    'full_name' => $user->full_name,
                    'project_assignment_id' => $user->pivot->id,
                    'status' => $user->pivot->status,
                    'note' => $user->pivot->note,
                    'assign_logs' => $logs,
                ];
            });
        }

        $viewData = [
            'projectAssignmentDetail' => $projectAssignmentDetail,
            'usersWithLogs' => $usersWithLogs,
        ];

        return view('pages.project.project_assign.project_assignment_detail', $viewData);
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showUpdateMemberAssignment(Request $request, $projectAssignId)
    {
        $validator = Validator::make(['id' => $projectAssignId], [
            'id' => ['required', 'numeric', 'integer', Rule::exists(ProjectAssignment::class, 'id')],
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $projectAssign = ProjectAssignment::with(['project', 'user',
            'logs' => function ($query) {
                $query->orderBy('project_join_date', 'desc');
            }])->find((int)$projectAssignId);

        $viewData = [
            'projectAssign' => $projectAssign,
        ];

        return view('pages.project.project_assign.update_member_assignment', $viewData);
    }

    /**
     * @return RedirectResponse
     */
    public function processUpdateProjectAssignmentLog(ProjectAssignLogRequest $request, $projectAssignId)
    {
        $validator = Validator::make(['id' => $projectAssignId], [
            'id' => ['required', 'numeric', 'integer', Rule::exists(ProjectAssignment::class, 'id')],
        ]);
        if ($validator->fails()) {
            abort(404);
        }
        $projectAssign = ProjectAssignment::with(['project', 'logs', 'user'])->find((int)$projectAssignId);

        $validated = $request->validated();

        try {

            DB::transaction(function () use ($projectAssign, $validated) {
                foreach ($validated['logs'] as $logKey => $logValue) {
                    $conditions = [
                        'id' => $logValue['id'],
                    ];

                    $data = [
                        'project_assignment_id' => $projectAssign->id,
                        'project_id' => $projectAssign->project_id,
                        'user_id' => $projectAssign->user_id,
                        'project_join_date' => $logValue['project_join_date'],
                        'project_exit_date' => $logValue['project_exit_date'],
                        'effort_percentage' => $logValue['effort_percentage'],
                        'worked_days' => $logValue['worked_days'],
                    ];

                    ProjectAssignmentLog::query()->updateOrCreate($conditions, $data);
                }
            });

            return redirect()->route('project.assign.showProjectAssignmentDetail', ['projectId' => $projectAssign->project_id]);
        } catch (Throwable $ex) {
            Log::error(__METHOD__ . '(): ' . $ex->getMessage());

            return back()->withInput();
        }
    }
}
