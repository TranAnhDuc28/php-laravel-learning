<?php

namespace App\Http\Controllers;

use App\Models\Teams;
use App\Services\CommonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamsController extends Controller
{
//    private CommonService $commonService;
//
//    public function __construct(CommonService $commonService)
//    {
//        $this->commonService = $commonService;
//    }

    public function index()
    {
        $forms = Teams::orderBy('id', 'asc')->paginate(10);
        return view('teams.index', compact('forms'));
    }

    public function create()
    {
//        $exceedDay = $this->commonService->startDayApplicationForm();
        return view('teams.create', [
            'exceedDay' => "",
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'team_name' => [
                'required',
                'string',
                'max:20',
                'regex:/^[a-zA-Z]+$/',  // chỉ cho phép chữ cái, không có dấu cách
//                'not_regex:/\s/',        // không cho phép khoảng trắng
                'unique:teams,team_name',
            ],
        ], [
            'team_name.required' => __('messages.team_name.required'),
            'team_name.string' => __('messages.team_name.string'),
            'team_name.max' => __('messages.team_name.max'),
            'team_name.regex' => __('messages.team_name.regex'),
            'team_name.not_regex' => __('messages.team_name.not_regex'),
            'team_name.unique' => __('messages.team_name.unique'),
        ]);

        $form = new Teams([
            'team_name' => $validated['team_name'],
        ]);
        $form->save();

        return redirect()->route('teams.index')
            ->with('success', 'Teams created successfully.');
    }

    public function edit(Teams $teams)
    {
        return view('teams.edit', compact('teams'));
    }

    public function update(Request $request, Teams $teams)
    {
        $validated = $request->validate([
            'team_name' => [
                'required',
                'string',
                'max:20',
                'regex:/^[a-zA-Z ]+$/',  // chỉ cho phép chữ cái, không có dấu cách
//                'not_regex:/\s/',        // không cho phép khoảng trắng
//                'unique:teams,team_name',
            ],
        ], [
            'team_name.required' => __('messages.team_name.required'),
            'team_name.string' => __('messages.team_name.string'),
            'team_name.max' => __('messages.team_name.max'),
            'team_name.regex' => __('messages.team_name.regex'),
            'team_name.not_regex' => __('messages.team_name.not_regex'),
//            'team_name.unique' => __('messages.team_name.unique'),
        ]);

        $teams->team_name = $validated['team_name'];
        $teams->save();

        return redirect()->route('teams.index')
            ->with('success', 'Team updated successfully.');
    }

    public function destroy(Teams $teams)
    {
        $teams->delete();

        return redirect()->route('teams.index')
            ->with('success', 'Team deleted successfully.');
    }
}
