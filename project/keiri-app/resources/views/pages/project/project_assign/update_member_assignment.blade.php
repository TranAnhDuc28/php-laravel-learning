@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')

@section('title', __('Update Member Assignment | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Update member assignment'"
                :breadcrumbs="[
                   ['label' => 'Project assignment', 'url' => route('project.assign.showProjectAssignment')],
                   ['label' => 'Project assignment detail', 'url' => route('project.assign.showProjectAssignmentDetail', ['projectId' => $projectAssign->project_id])],
                   ['label' => 'Update member assignment', 'url' => null],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    @php
                                        $priorityLabel = 'Medium';
                                        if ($projectAssign->project->priority === \App\Enums\ProjectPriority::HIGH) {
                                            $priorityLabel = 'High';
                                        } else if($projectAssign->project->priority === \App\Enums\ProjectPriority::LOW){
                                            $priorityLabel = 'Low';
                                        }

                                        $statusLabel = 'Not started';
                                        if ($projectAssign->project->status === \App\Enums\ProjectStatus::IN_PROGRESS) {
                                            $statusLabel = 'In progress';
                                        } else if ($projectAssign->project->status === \App\Enums\ProjectStatus::COMPLETED) {
                                            $statusLabel = 'Completed';
                                        }
                                    @endphp
                                    <tbody>
                                    <tr>
                                        <td colspan="7">
                                            <div class="d-flex justify-content-between m-0">
                                                <div class="fs-16 fw-bold m-0">{{ __('Project Information') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Project Code') }}</th>
                                        <td colspan="6">{{ $projectAssign->project->project_code }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Project Name') }}</th>
                                        <td colspan="6">{{ $projectAssign->project->project_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Project start date') }}</th>
                                        <td colspan="3">{{ \Carbon\Carbon::parse($projectAssign->project->project_start_date)->format('d-m-Y') }}</td>
                                        <th scope="row">{{ __('Project end date') }}</th>
                                        <td colspan="2">{{ \Carbon\Carbon::parse($projectAssign->project->project_end_date)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Phase') }}</th>
                                        <td>{{ $projectAssign->project->phase }}</td>
                                        <th scope="row">{{ __('Priority') }}</th>
                                        <td>{{ $priorityLabel }}</td>
                                        <th scope="row">{{ __('Status') }}</th>
                                        <td colspan="2">{{ $statusLabel }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Project outline') }}</th>
                                        <td colspan="6">{{ $projectAssign->project->note }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- Form update member assign detail --}}
                            <div class="fs-16 fw-bold">{{ __('Members') }}</div>
                            <div class="px-2">
                                <div class="mt-2">
                                    <div class="d-flex gap-4 align-items-center">
                                        {{ $projectAssign->user->full_name }}
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
                                <form action="" method="POST">
                                    @if($projectAssign->logs)
                                        @foreach($projectAssign->logs as $projectAssignMemberDetail)
                                            <div>
                                                <div class="row">
                                                    <div class="col-sm-12 col-md-12 col-lg-1 mt-3 d-flex align-items-center">
                                                        <div>
                                                            #{{ $loop->iteration }}
                                                            <span class="badge-dot {{ $projectAssignMemberDetail->project_exit_date ? 'badge-dot-dark' : 'badge-dot-success' }}"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                                                        <label for="id-project_join_date" class="form-label">{{ __('Join date') }}</label>
                                                        <div class="input-group">
                                                            <input type="text" id="id-project_join_date" name="project_join_date"
                                                                   class="form-control @error('project_join_date') is-invalid @enderror"
                                                                   value="{{ old('project_join_date', $projectAssignMemberDetail->project_join_date ? Carbon::parse($projectAssignMemberDetail->project_join_date)->format('d-m-Y') : null) }}">
                                                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                        </div>
                                                        @error('project_join_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                                                        <label for="id-project_exit_date" class="form-label">{{ __('Exit date') }}</label>
                                                        <div class="input-group">
                                                            <input type="text" id="id-project_exit_date" name="project_exit_date"
                                                                   class="form-control @error('project_exit_date') is-invalid @enderror"
                                                                   value="{{ old('project_exit_date', $projectAssignMemberDetail->project_exit_date ? Carbon::parse($projectAssignMemberDetail->project_exit_date)->format('d-m-Y') : null)  }}">
                                                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                        </div>
                                                        @error('project_exit_date')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-2 mt-3">
                                                        <label for="id-effort_percentage" class="form-label text-nowrap">{{ __('Effort Percentage') }}</label>
                                                        <input type="number" id="id-effort_percentage" name="effort_percentage" min="0" max="100"
                                                               class="form-control @error('effort_percentage') is-invalid @enderror"
                                                               value="{{ old('effort_percentage', $projectAssignMemberDetail->effort_percentage) }}">
                                                        @error('effort_percentage')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                                                        <label for="id-worked_days" class="form-label">{{ __('Worked days') }}</label>
                                                        <input type="number" id="id-worked_days" name="worked_days"
                                                               class="form-control @error('worked_days') is-invalid @enderror"
                                                               value="{{ old('worked_days', $projectAssignMemberDetail->worked_days) }}">
                                                        @error('worked_days')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @if(!$loop->last)
                                                <hr class="mb-0">
                                            @endif
                                        @endforeach
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
