<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectAssignment;
use App\Models\ProjectAssignmentLog;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class ProjectAssignmentController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showProjectAssignment()
    {
        $projectAssignments = Project::with([
            'users' => fn($query) => $query->select('users.id', 'users.full_name')
        ])->select('id', 'project_code', 'project_name')->get();

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
        $projectAssignmentLogs = null;
        $usersWithLogs = null;
        $projectAssignmentDetail = Project::with([
            'users' => function ($query) {
                $query->select('users.id', 'users.full_name');
            }])->find($projectId);

        // Get list id member assign.
        if ($projectAssignmentDetail) {
            $projectAssignIds = $projectAssignmentDetail->users->pluck('pivot.id')->toArray();
            $projectAssignmentLogs = ProjectAssignmentLog::query()->whereIn('project_assignment_id', $projectAssignIds)->get();

            $usersWithLogs = $projectAssignmentDetail->users->map(function ($user) use ($projectAssignmentLogs) {
                $logs = $projectAssignmentLogs->where('project_assignment_id', $user->pivot->id);
                return [
                    'id' => $user->id,
                    'full_name' => $user->full_name,
                    'is_manager' => $user->pivot->is_manager,
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
}
