@extends('layouts.app')

@section('title', __('Project Assignment Detail | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Project assignment detail'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Project assignment detail', 'url' => null],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered">
                                @php
                                    $priorityLabel = 'Medium';
                                    if ($projectAssignmentDetail->priority == \App\Enums\ProjectPriority::HIGH) {
                                        $priorityLabel = 'High';
                                    } else if($projectAssignmentDetail->priority == \App\Enums\ProjectPriority::LOW){
                                        $priorityLabel = 'Low';
                                    }

                                    $statusLabel = 'Not started';
                                    if ($projectAssignmentDetail->status == \App\Enums\ProjectStatus::IN_PROGRESS) {
                                        $statusLabel = 'In progress';
                                    } else if ($projectAssignmentDetail->status == \App\Enums\ProjectStatus::COMPLETED) {
                                        $statusLabel = 'Completed';
                                    }
                                @endphp
                                <tbody>
                                <tr>
                                    <td colspan="7">
                                        <div class="d-flex justify-content-between m-0">
                                            <div class="fs-16 fw-bold m-0">{{ __('Project Information') }}</div>
                                            <div class="m-0">
                                                <a class="btn btn-primary btn-sm" href="{{ route('project.showUpdateProjectForm', ['projectId' => $projectAssignmentDetail->id]) }}"
                                                   data-bs-toggle="tooltip" data-bs-title="{{ __('Edit project information') }}">
                                                    Edit
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Project Code') }}</th>
                                    <td colspan="6">{{ $projectAssignmentDetail->project_code }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Project Name') }}</th>
                                    <td colspan="6">{{ $projectAssignmentDetail->project_name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Project start date') }}</th>
                                    <td colspan="3">{{ \Carbon\Carbon::parse($projectAssignmentDetail->project_start_date)->format('d-m-Y') }}</td>
                                    <th scope="row">{{ __('Project end date') }}</th>
                                    <td colspan="2">{{ \Carbon\Carbon::parse($projectAssignmentDetail->project_end_date)->format('d-m-Y') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Phase') }}</th>
                                    <td>{{ $projectAssignmentDetail->phase }}</td>
                                    <th scope="row">{{ __('Priority') }}</th>
                                    <td>{{ $priorityLabel }}</td>
                                    <th scope="row">{{ __('Status') }}</th>
                                    <td colspan="2">{{ $statusLabel }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">{{ __('Project outline') }}</th>
                                    <td colspan="6">{{ $projectAssignmentDetail->note }}</td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        <div class="d-flex justify-content-between m-0">
                                            <div class="fs-16 fw-bold m-0">{{ __('Team members') }}</div>
                                            <div class="m-0">
                                                <button class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="{{ __('Update project member details') }}">Edit</button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Full name') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Join date') }}</th>
                                    <th>{{ __('Exit date') }}</th>
                                    <th>{{ __('Effort percentage') }}</th>
                                    <th>{{ __('Worked days') }}</th>
                                    <th>{{ __('Status') }}</th>
                                </tr>
                                @foreach($usersWithLogs as $user)
                                    @php
                                        $countRowspan = $user['assign_logs']->count();
                                    @endphp
                                    @if($user['assign_logs']->isNotEmpty())
                                        @foreach($user['assign_logs'] as $assign_logs)
                                            <tr>
                                                @if ($loop->first)
                                                    <td rowspan="{{ $countRowspan }}">{{ $user['full_name'] }}</td>
                                                    <td rowspan="{{ $countRowspan }}">{{ $user['is_manager'] ? __('Manager') : __('Member') }}</td>
                                                @endif
                                                <td>{{ $assign_logs->project_join_date ? \Carbon\Carbon::parse($assign_logs->project_join_date)->format('d-m-Y') : '-' }}</td>
                                                <td>{{ $assign_logs->project_exit_date ? \Carbon\Carbon::parse($assign_logs->project_exit_date)->format('d-m-Y') : '-' }}</td>
                                                <td>{{ $assign_logs->effort_percentage ?? 0 }}%</td>
                                                <td>{{ $assign_logs->worked_days ?? 0 }}</td>
                                                <td>{{ $assign_logs->status == \App\Enums\AssignmentLogStatus::ACTIVE->value ? __('Active') : __('Inactive') }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>{{ $user['full_name'] }}</td>
                                            <td>{{ $user['is_manager'] ? __('Manager') : __('Member') }}</td>
                                            <td colspan="5">{{ __('-') }}</td>
                                        </tr>
                                    @endif
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
