<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class HumanResourcesController extends Controller
{
    public function showEmployeeList()
    {
        $employees = User::all();

        $dataView = [
            'employees' => $employees
        ];

        return view('pages.employee.list', $dataView);
    }

    public function showCreateEmployeeForm()
    {
        $departments = Department::all();

        $dataView = [
            'departments' => $departments,
        ];

        return view('pages.employee.create', $dataView);
    }
}
