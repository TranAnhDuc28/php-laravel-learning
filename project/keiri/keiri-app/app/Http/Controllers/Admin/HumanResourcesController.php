<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Models\Department;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $employees = User::with('department')
            ->whereNot('role', UserRole::ADMIN)
            ->orderBy('full_name')
            ->get();

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
        $departments = Department::orderBy('name')->get();

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
            $employee->role = (int)$validated['role'];
            $employee->username = $validated['username'] ?? null;
            $employee->password = $validated['password'] ?? null;
            $employee->email = $validated['email'] ?? null;
            $employee->employee_costs = $validated['employee_costs'] ?? 0;
            $employee->note = $validated['note'] ?? null;
            $employee->save();

            return redirect()->route('employee.showEmployeeList')->with('success', 'Employee created successfully!');
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

        $employee = User::find((int)$id);
        $departments = Department::orderBy('name')->get();

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

        $employee = User::find((int)$id);

        $validated = $request->validated();

        try {
            $employee->department_id = $validated['department_id'] ?? null;
            $employee->job_position = $validated['job_position'] ?? null;
            $employee->full_name = $validated['full_name'];
            $employee->role = (int)$validated['role'];
            $employee->username = $validated['username'] ?? null;
            $employee->password = $validated['password'] ?? null;
            $employee->email = $validated['email'] ?? null;
            $employee->employee_costs = $validated['employee_costs'] ?? 0;
            $employee->note = $validated['note'] ?? null;
            $employee->status = $validated['status'];
            $employee->save();

            return redirect()->route('employee.showEmployeeList')->with('success', 'Employee updated successfully!');
        } catch (Throwable $ex) {
            Log::error(__METHOD__ . '(): ' . $ex->getMessage());

            return back()->withInput();
        }
    }

    /**
     * @return Factory|View|Application|object
     */
    public function showEmployeePaymentCosts()
    {
        return view('pages.employee.payment_costs.payment_costs_list');
    }
}
