<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\TeamUser;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
//    private CommonService $commonService;
//
//    public function __construct(CommonService $commonService)
//    {
//        $this->commonService = $commonService;
//    }

    public function index()
    {
        $forms = Projects::orderBy('id', 'asc')->with('user')->get();
        return view('projects.index', compact('forms'));
    }

    public function create()
    {
        $managers = TeamUser::where('role', 1) // role manager
        ->with('user')
        ->get();

        return view('projects.create', [
            'managers' => $managers,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_name' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9a-zA-Z ]+$/',  // chỉ cho phép chữ cái, không có dấu cách
//                'not_regex:/\s/',        // không cho phép khoảng trắng
                'unique:projects,project_name',
            ],
        ], [
            'project_name.required' => __('messages.project_name.required'),
            'project_name.string' => __('messages.project_name.string'),
            'project_name.max' => __('messages.project_name.max'),
            'project_name.regex' => __('messages.project_name.regex'),
            'project_name.not_regex' => __('messages.project_name.not_regex'),
            'project_name.unique' => __('messages.project_name.unique'),
        ]);

        $form = new Projects([
            'project_name' => $validated['project_name'],
            'user_id' => $request->user_id,
        ]);
        $form->save();

        return redirect()->route('projects.index')
            ->with('success', 'Projects created successfully.');
    }

    public function edit(Projects $projects)
    {
        $managers = TeamUser::where('role', 1) // role manager
        ->with('user')
            ->get();

        return view('projects.edit', compact('projects','managers'));
    }

    public function update(Request $request, Projects $projects)
    {
        $validated = $request->validate([
            'project_name' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9a-zA-Z ]+$/',  // chỉ cho phép chữ cái, không có dấu cách
//                'not_regex:/\s/',        // không cho phép khoảng trắng
//                'unique:projects,project_name',
            ],
        ], [
            'project_name.required' => __('messages.project_name.required'),
            'project_name.string' => __('messages.project_name.string'),
            'project_name.max' => __('messages.project_name.max'),
            'project_name.regex' => __('messages.project_name.regex'),
            'project_name.not_regex' => __('messages.project_name.not_regex'),
//            'project_name.unique' => __('messages.project_name.unique'),
        ]);

        $projects->project_name = $validated['project_name'];
        $projects->user_id = $request->user_id;
        $projects->save();

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully.');
    }

    public function destroy(Projects $projects)
    {
        $projects->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
