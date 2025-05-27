@extends('layouts.app')

@section('title', __('Project Assignment Detail | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Project assignment detail'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Project assignment', 'url' => route('project.assign.showProjectAssignment')],
                   ['label' => 'Project assignment detail', 'url' => null],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    @php
//                                        $priorityLabel = 'Medium';
//                                        if ($projectAssignmentDetail->priority === \App\Enums\ProjectPriority::HIGH) {
//                                            $priorityLabel = 'High';
//                                        } else if($projectAssignmentDetail->priority === \App\Enums\ProjectPriority::LOW){
//                                            $priorityLabel = 'Low';
//                                        }

                                        $statusLabel = 'Not started';
                                        if ($projectAssignmentDetail->status === \App\Enums\ProjectStatus::IN_PROGRESS) {
                                            $statusLabel = 'In progress';
                                        } else if ($projectAssignmentDetail->status === \App\Enums\ProjectStatus::COMPLETED) {
                                            $statusLabel = 'Completed';
                                        }
                                    @endphp
                                    <tbody>
                                    <tr>
                                        <td colspan="7">
                                            <div class="d-flex justify-content-between m-0">
                                                <div class="fs-16 fw-bold m-0">{{ __('Project Information') }}</div>
                                                <div class="m-0">
                                                    <a class="btn btn-primary btn-sm"
                                                       href="{{ route('project.showUpdateProject', ['projectId' => $projectAssignmentDetail->id]) }}"
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
{{--                                        <th scope="row">{{ __('Phase') }}</th>--}}
{{--                                        <td>{{ $projectAssignmentDetail->phase }}</td>--}}
{{--                                        <th scope="row">{{ __('Priority') }}</th>--}}
{{--                                        <td>{{ $priorityLabel }}</td>--}}
                                        <th scope="row">{{ __('Status') }}</th>
                                        <td colspan="6">{{ $statusLabel }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Note') }}</th>
                                        <td colspan="6">{{ $projectAssignmentDetail->note }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            <div class="d-flex justify-content-between m-0">
                                                <div class="m-0">
                                                    <div class="fs-16 fw-bold ">{{ __('Team members') }}</div>
                                                    <div class="d-flex gap-4 align-items-center">
                                                        <div>
                                                            <span class="badge-dot badge-dot-success"></span>
                                                            {{ __('Joining') }}
                                                        </div>
                                                        <div>
                                                            <span class="badge-dot badge-dot-dark"></span>
                                                            {{ __('Leaving') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="2">{{ __('Full name') }}</th>
                                        <th>{{ __('Join date') }}</th>
                                        <th>{{ __('Exit date') }}</th>
                                        <th>{{ __('Effort percentage') }}</th>
                                        <th>{{ __('Worked days') }}</th>
                                        <th></th>
                                    </tr>
                                    @foreach($usersWithLogs as $user)
                                        @php
                                            $countRowspan = $user['assign_logs']->count();
                                        @endphp
                                        @if($user['assign_logs']->isNotEmpty())
                                            @foreach($user['assign_logs'] as $assignLog)
                                                <tr>
                                                    @if ($loop->first)
                                                        <td rowspan="{{ $countRowspan }}" colspan="2">
                                                            <span class="badge-dot {{ $user['status'] === \App\Enums\AssignmentStatus::ACTIVE ? 'badge-dot-success' : 'badge-dot-dark' }}"></span>
                                                            {{ $user['full_name'] }}
                                                        </td>
                                                    @endif
                                                    <td>{{ $assignLog->project_join_date ? \Carbon\Carbon::parse($assignLog->project_join_date)->format('d-m-Y') : '-' }}</td>
                                                    <td>{{ $assignLog->project_exit_date ? \Carbon\Carbon::parse($assignLog->project_exit_date)->format('d-m-Y') : '-' }}</td>
                                                    <td>{{ $assignLog->effort_percentage ?? 0 }}%</td>
                                                    <td>{{ $assignLog->worked_days ?? 0 }}</td>
                                                    @if ($loop->first)
                                                        <td rowspan="{{ $countRowspan }}" class="text-center align-middle" style="width: 50px">
                                                            <a href="{{route('project.assign.showUpdateMemberAssignment', ['projectAssignId' => $user['project_assignment_id']])}}"
                                                               class="btn btn-light p-1 border-0" data-bs-toggle="tooltip" data-bs-title="{{ __('Edit') }}">
                                                                {{-- {{ __('Edit') }} --}}
                                                                <i class="ri-edit-line"></i>
                                                            </a>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2">
                                                    <span class="badge-dot {{ $user['status'] === \App\Enums\AssignmentStatus::ACTIVE ? 'badge-dot-success' : 'badge-dot-dark' }}"></span>
                                                    {{ $user['full_name'] }}
                                                </td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td class="text-center align-middle" style="width: 50px">
                                                    <a href="{{route('project.assign.showUpdateMemberAssignment', ['projectAssignId' => $user['project_assignment_id']])}}"
                                                       class="btn btn-light p-1 border-0" data-bs-toggle="tooltip" data-bs-title="{{ __('Edit') }}">
                                                        {{-- {{ __('Edit') }} --}}
                                                        <i class="ri-edit-line"></i>
                                                    </a>
                                                </td>
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
    </div>
@endsection
