@extends('layouts.app')

@section('title', __('Employee List | Human Resources'))

@section('content')
    <div class="page-content">
        <div class="container-fluid h-100">
            <x-breadcrumb
                :title="'Employee List'"
                :breadcrumbs="[
                   ['label' => 'Human Resources', 'url' => null],
                   ['label' => 'Employee List', 'url' => route('project.showProjectList')],
                ]"
            />

            <div class="row h-100">
                <div class="col-lg-12 h-100">
                    <div class="card h-100">
                        <div class="card-body h-100">
                            <div class="table-responsive h-100">
                                <table id="employee_list" class="table table-striped nowrap w-100 h-100">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Working department</th>
                                        <th>Position</th>
                                        <th>Phone Number</th>
                                        <th>Date Of Birth</th>
                                        <th>Join Date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $employee)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $employee->full_name }}</td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->department_id }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>{{ $employee->phone_number }}</td>
                                            <td>{{ $employee->date_of_birth }}</td>
                                            <td>{{ $employee->join_date }}</td>
                                            <td>{{ $employee->status }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-light btn-sm">...</button>
                                            </td>
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
    </div>
@endsection
