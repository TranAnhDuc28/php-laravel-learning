<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teams;
use App\Models\TeamUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TeamUserController extends Controller
{
    public function index()
    {
//        $forms = TeamUser::orderBy('id', 'asc')->paginate(10);
//        return view('team_user.index', compact('forms'));
//        $users = User::select('id', 'email', 'name')->get();
        $users = User::select('id', 'email', 'name')
            ->where('role', '=', 1)
//            ->where('role', '!=', 0)
//            ->where('role', '!=', 9)
            ->get();
        $teams = Teams::select('id', 'team_name')->get();
        $teamUsers = TeamUser::select('user_id', 'team_id', 'role')->get()->keyBy('user_id');
//        dd($teamUsers, $teams);
        return view('team_user.index', compact('users', 'teams', 'teamUsers'));
    }

    public function update(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            $teamName = $request->input('team_id');
            $role = $request->input('role');
            TeamUser::updateOrCreate(
                ['user_id' => (int)$userId],
                [
                    'team_id' => $teamName ?: null,
                    'role' => $role ?: null
                ]
            );

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

//    public function create()
//    {
////        $exceedDay = $this->commonService->startDayApplicationForm();
//        return view('team_user.create', [
//            'exceedDay' => "",
//        ]);
//    }
//
//    public function store(Request $request)
//    {
//        $validated = $request->validate([
//            'team_name' => [
//                'required',
//                'string',
//                'max:20',
//                'regex:/^[a-zA-Z]+$/',  // chỉ cho phép chữ cái, không có dấu cách
//                'not_regex:/\s/',        // không cho phép khoảng trắng
//                'unique:teams,team_name',
//            ],
//        ], [
//            'team_name.required' => __('messages.team_name.required'),
//            'team_name.string' => __('messages.team_name.string'),
//            'team_name.max' => __('messages.team_name.max'),
//            'team_name.regex' => __('messages.team_name.regex'),
//            'team_name.not_regex' => __('messages.team_name.not_regex'),
//            'team_name.unique' => __('messages.team_name.unique'),
//        ]);
//
//        $form = new TeamUser([
//            'team_name' => $validated['team_name'],
//        ]);
//        $form->save();
//
//        return redirect()->route('team_user.index')
//            ->with('success', 'Member added successfully.');
//    }
//
//    public function edit(TeamUser $team_user)
//    {
//        return view('team_user.edit', compact('team_user'));
//    }
//
//    public function update(Request $request, TeamUser $team_user)
//    {
//        $validated = $request->validate([
//            'team_name' => [
//                'required',
//                'string',
//                'max:20',
//                'regex:/^[a-zA-Z]+$/',  // chỉ cho phép chữ cái, không có dấu cách
//                'not_regex:/\s/',        // không cho phép khoảng trắng
//                'unique:teams,team_name',
//            ],
//        ], [
//            'team_name.required' => __('messages.team_name.required'),
//            'team_name.string' => __('messages.team_name.string'),
//            'team_name.max' => __('messages.team_name.max'),
//            'team_name.regex' => __('messages.team_name.regex'),
//            'team_name.not_regex' => __('messages.team_name.not_regex'),
//            'team_name.unique' => __('messages.team_name.unique'),
//        ]);
//
//        $team_user->team_name = $validated['team_name'];
//        $team_user->save();
//
//        return redirect()->route('team_user.index')
//            ->with('success', 'Team updated successfully.');
//    }
//
//    public function destroy(TeamUser $team_user)
//    {
//        $team_user->delete();
//
//        return redirect()->route('team_user.index')
//            ->with('success', 'Team deleted successfully.');
//    }
}
