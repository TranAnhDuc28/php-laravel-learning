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
                                        <th>{{ __('Full Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Working department') }}</th>
                                        <th>{{ __('Position') }}</th>
{{--                                        <th>{{ __('Phone Number') }}</th>--}}
{{--                                        <th>{{ __('Date Of Birth') }}</th>--}}
                                        <th>{{ __('Join Date') }}</th>
                                        <th>{{ __('Status') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($employees as $employee)
                                        @php
                                            $employeeStatusClassStyle = null;
                                            $employeeStatusLabel = null;
                                            if ($employee->status === \App\Enums\UserStatus::ACTIVE) {
                                                $employeeStatusClassStyle = 'badge bg-success-subtle text-success';
                                                $employeeStatusLabel = 'Active';
                                            } else if($employee->status === \App\Enums\UserStatus::INACTIVE){
                                                $employeeStatusClassStyle = 'badge bg-secondary-subtle text-secondary';
                                                $employeeStatusLabel = 'Inactive';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('employee.showUpdateEmployee', ['id' => $employee->id]) }}" class="text-decoration-underline">{{ $employee->full_name }}</a>
                                            </td>
                                            <td>{{ $employee->email }}</td>
                                            <td>{{ $employee->department->name ?? '' }}</td>
                                            <td>{{ $employee->position }}</td>
{{--                                            <td>{{ $employee->phone_number }}</td>--}}
{{--                                            <td>{{ $employee->date_of_birth }}</td>--}}
                                            <td>{{ $employee->join_date }}</td>
                                            <td>
                                                <span class="{{ $employeeStatusClassStyle }} fs-12">{{ $employeeStatusLabel }}</span>
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
