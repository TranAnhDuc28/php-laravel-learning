@extends('layouts.app')

@section('title', __('Employee List | Human Resources'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Employee List'"
                :breadcrumbs="[
                   ['label' => 'Human Resources', 'url' => null],
                   ['label' => 'Employee List', 'url' => route('project.showProjectList')],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="employee_list" class="table table-bordered table-responsive-lg nowrap align-middle w-100">
                                <thead>
                                <tr>
                                    <th class="border">#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Working department</th>
                                    <th>phone_number</th>
                                    <th>date_of_birth</th>
                                    <th>join_date</th>
                                    <th>position</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $employee->full_name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->department_id }}</td>
                                        <td>{{ $employee->phone_number }}</td>
                                        <td>{{ $employee->date_of_birth }}</td>
                                        <td>{{ $employee->join_date }}</td>
                                        <td>{{ $employee->position }}</td>
                                        <td>{{ $employee->status }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
