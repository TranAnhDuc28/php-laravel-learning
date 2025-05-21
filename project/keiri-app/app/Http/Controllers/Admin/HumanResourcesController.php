<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Throwable;

class HumanResourcesController extends Controller
{
    /**
     * @return Factory|View|Application|object
     */
    public function showEmployeeList()
    {
        $employees = User::with('department')->get();

        $dataView = [
            'employees' => $employees
        ];

        return view('pages.employee.list', $dataView);
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showCreateEmployee()
    {
        $departments = Department::all();

        $dataView = [
            'departments' => $departments,
        ];

        return view('pages.employee.create', $dataView);
    }

    /**
     * @return Factory|View|Application|object
     */
    public function processCreateEmployee(EmployeeRequest $request)
    {
        $validated = $request->validated();

        try {
            $employee = new User();
            $employee->department_id = $validated['department_id'] ?? null;
            $employee->job_position = $validated['job_position'] ?? null;
            $employee->full_name = $validated['full_name'];
            $employee->email = $validated['email'];
            $employee->password = $validated['password'];
            $employee->join_date = $validated['join_date'] ?? null;
            $employee->note = $validated['note'] ?? null;
            $employee->save();

            return redirect()->route('employee.showEmployeeList');
        } catch (Throwable $ex) {
            Log::error(__METHOD__ . '(): ' . $ex->getMessage());

            return back()->withInput();
        }
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showUpdateEmployee(Request $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'numeric', 'integer', Rule::exists(User::class, 'id')],
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $employee = User::find($id);
        $departments = Department::all();

        $dataView = [
            'employee' => $employee,
            'departments' => $departments,
        ];

        return view('pages.employee.update', $dataView);
    }

    /**
     * @return Factory|View|Application|object
     */
    public function processUpdateEmployee(EmployeeRequest $request, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => ['required', 'numeric', 'integer', Rule::exists(User::class, 'id')],
        ]);
        if ($validator->fails()) {
            abort(404);
        }

        $employee = User::find($id);

        $validated = $request->validated();

        try {
            $employee->department_id = $validated['department_id'] ?? null;
            $employee->job_position = $validated['job_position'] ?? null;
            $employee->full_name = $validated['full_name'];
            $employee->email = $validated['email'];
            $employee->join_date = $validated['join_date'] ?? null;
            $employee->note = $validated['note'] ?? null;
            $employee->status = $validated['status'];
            $employee->save();

            return redirect()->route('employee.showEmployeeList');
        } catch (Throwable $ex) {
            Log::error(__METHOD__ . '(): ' . $ex->getMessage());

            return back()->withInput();
        }
    }
}
