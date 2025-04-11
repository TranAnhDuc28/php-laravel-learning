<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Projects;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProjectUserController extends Controller
{
    public function index()
    {
        $existingProjectManagers = Projects::pluck('user_id');
        $users = User::select('id', 'email', 'name')
            ->where('role', '=', 1)
            ->whereNotIn('id', $existingProjectManagers)
            ->get();

        $projects = Projects::select('id', 'project_name')->get();
        $projectUsers = ProjectUser::select('user_id', 'project_id')->get()->keyBy('user_id');

        return view('project_user.index', compact('users', 'projects', 'projectUsers'));
    }

    public function update(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $projectName = $request->input('project_id');

            ProjectUser::updateOrCreate(
                ['user_id' => (int)$userId],
                [
                    'project_id' => $projectName ?: null,
                ]
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
