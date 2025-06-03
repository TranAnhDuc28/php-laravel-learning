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
                                        //                                        $priorityLabel = 'Medium';
                                        //                                        if ($projectAssign->project->priority === \App\Enums\ProjectPriority::HIGH) {
                                        //                                            $priorityLabel = 'High';
                                        //                                        } else if($projectAssign->project->priority === \App\Enums\ProjectPriority::LOW){
                                        //                                            $priorityLabel = 'Low';
                                        //                                        }

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
                                        <td colspan="5">{{ $projectAssign->project->project_code }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Project Name') }}</th>
                                        <td colspan="5">{{ $projectAssign->project->project_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Project start date') }}</th>
                                        <td>{{ \Carbon\Carbon::parse($projectAssign->project->project_start_date)->format('d-m-Y') }}</td>
                                        <th scope="row">{{ __('Project end date') }}</th>
                                        <td>{{ \Carbon\Carbon::parse($projectAssign->project->project_end_date)->format('d-m-Y') }}</td>
                                    </tr>
                                    <tr>
                                        {{--                                        <th scope="row">{{ __('Phase') }}</th>--}}
                                        {{--                                        <td>{{ $projectAssign->project->phase }}</td>--}}
                                        {{--                                        <th scope="row">{{ __('Priority') }}</th>--}}
                                        {{--                                        <td>{{ $priorityLabel }}</td>--}}
                                        <th scope="row">{{ __('Status') }}</th>
                                        <td colspan="5">{{ $statusLabel }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Note') }}</th>
                                        <td colspan="5">{{ $projectAssign->project->note }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- Form update member assign detail --}}
                            <form action="{{ route('project.assign.processUpdateProjectAssignmentLog', ['projectAssignId' => $projectAssign->id]) }}" method="POST" class="mt-3">
                                @csrf
                                @method('PUT')
                                <table class="table table-bordered">
                                    <tr>
                                        <td colspan="2">
                                            <div class="d-flex justify-content-between m-0">
                                                <div class="m-0">
                                                    <div class="fs-16 fw-bold">{{ __('Members') }}</div>
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
                                        <th scope="row" style="width: 200px">{{ __('Full name') }}</th>
                                        <td>{{ $projectAssign->user->full_name }}</td>
                                    </tr>
                                    @if($projectAssign->logs)
                                        @foreach($projectAssign->logs as $projectAssignLog)
                                            <tr>
                                                <td colspan="2">
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                                            <div>
                                                                #{{ $loop->iteration }}
                                                                <span class="badge-dot {{ $projectAssignLog->project_exit_date ? 'badge-dot-dark' : 'badge-dot-success' }}"></span>
                                                            </div>
                                                            <a href="{{ route('project.assign.processDeleteProjectAssignmentLog', ['projectAssignLogId' => $projectAssignLog->id]) }}"
                                                               class="btn btn-light p-1 border-0 btn-delete-assign-log"
                                                               data-log-id="{{ $projectAssignLog->id }}" data-bs-toggle="tooltip" data-bs-title="{{ __('Delete') }}">
                                                                <i class="ri-delete-bin-5-line text-danger"></i>
                                                            </a>
                                                        </div>

                                                        @if($errors->has("logs.{$projectAssignLog->id}.id"))
                                                            @php
                                                                $messages = collect($errors->get('logs.' . $projectAssignLog->id . '.id') ?? [])->all();
                                                            @endphp
                                                            <div class="row m-0 px-3">
                                                                <x-alert
                                                                    :className="'mt-3 msg-err'"
                                                                    :type="'danger'"
                                                                    :messages="$messages"
                                                                />
                                                            </div>
                                                        @endif

                                                        <input type="hidden" name="logs[{{ $projectAssignLog->id }}][id]" value="{{ $projectAssignLog->id }}">
                                                        <!-- Các trường khác -->
                                                        <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                                                            <label for="id-project_join_date-{{ $projectAssignLog->id }}" class="form-label">{{ __('Join date') }}</label>
                                                            <div class="input-group">
                                                                <input type="text" id="id-project_join_date-{{ $projectAssignLog->id }}"
                                                                       name="logs[{{ $projectAssignLog->id }}][project_join_date]" autocomplete="off"
                                                                       class="project_join_date form-control @error('logs.' . $projectAssignLog->id . '.project_join_date') is-invalid @enderror"
                                                                       value="{{ old('logs.' . $projectAssignLog->id . '.project_join_date', $projectAssignLog->project_join_date ? Carbon::parse($projectAssignLog->project_join_date)->format('d-m-Y') : null) }}">
                                                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                            </div>
                                                            @error('logs.' . $projectAssignLog->id . '.project_join_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                                                            <label for="id-project_exit_date-{{ $projectAssignLog->id }}" class="form-label">{{ __('Exit date') }}</label>
                                                            <div class="input-group">
                                                                <input type="text" id="id-project_exit_date-{{ $projectAssignLog->id }}"
                                                                       name="logs[{{ $projectAssignLog->id }}][project_exit_date]" autocomplete="off"
                                                                       class="project_exit_date flatpickr flatpickr-input form-control @error('logs.' . $projectAssignLog->id . '.project_exit_date') is-invalid @enderror"
                                                                       value="{{ old('logs.' . $projectAssignLog->id . '.project_exit_date', $projectAssignLog->project_exit_date ? Carbon::parse($projectAssignLog->project_exit_date)->format('d-m-Y') : null)  }}">
                                                                <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                            </div>
                                                            @error('logs.' . $projectAssignLog->id . '.project_exit_date')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                                                            <label for="id-effort_percentage-{{ $projectAssignLog->id }}" class="form-label text-nowrap">{{ __('Effort Percentage') }}</label>
                                                            <input type="number" id="id-effort_percentage-{{ $projectAssignLog->id }}"
                                                                   name="logs[{{ $projectAssignLog->id }}][effort_percentage]" min="0" max="100"
                                                                   class="form-control flatpickr flatpickr-input @error('logs.' . $projectAssignLog->id . '.effort_percentage') is-invalid @enderror"
                                                                   value="{{ old('logs.' . $projectAssignLog->id . '.effort_percentage', $projectAssignLog->effort_percentage) }}">
                                                            @error('logs.' . $projectAssignLog->id . '.effort_percentage')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-12 col-md-6 col-lg-3 mt-3">
                                                            <label for="id-worked_days-{{ $projectAssignLog->id }}" class="form-label">{{ __('Worked days') }}</label>
                                                            <input type="number" id="id-worked_days-{{ $projectAssignLog->id }}"
                                                                   name="logs[{{ $projectAssignLog->id }}][worked_days]"
                                                                   class="form-control @error('logs.' . $projectAssignLog->id . '.worked_days') is-invalid @enderror"
                                                                   value="{{ old('logs.' . $projectAssignLog->id . '.worked_days', $projectAssignLog->worked_days) }}">
                                                            @error('logs.' . $projectAssignLog->id . '.worked_days')
                                                            <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                        {{--                                                    <div class="col-sm-12 col-md-12 col-lg-12 mt-3">--}}
                                                        {{--                                                        <div class="row">--}}
                                                        {{--                                                            <div class="col-lg-1">--}}
                                                        {{--                                                                <label for="id-note-{{ $projectAssignLog->id }}" class="form-label">{{ __('Note') }}</label>--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                            <div class="col-lg-11">--}}
                                                        {{--                                                                <textarea id="id-note" name="logs[{{ $projectAssignLog->id }}][note]" rows="1"--}}
                                                        {{--                                                                          class="form-control @error('logs.' . $projectAssignLog->id . '.note') is-invalid @enderror">{{ old('logs.' . $projectAssignLog->id . '.note', $projectAssignLog->note) }}</textarea>--}}
                                                        {{--                                                                @error('logs.' . $projectAssignLog->id . '.note')--}}
                                                        {{--                                                                <span class="invalid-feedback" role="alert">--}}
                                                        {{--                                                                    <strong>{{ $message }}</strong>--}}
                                                        {{--                                                                </span>--}}
                                                        {{--                                                                @enderror--}}
                                                        {{--                                                            </div>--}}
                                                        {{--                                                        </div>--}}
                                                        {{--                                                    </div>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </table>
                                <div class="text-end mt-3">
                                    <button type="submit" id="btn-save-project" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal delete -->
    <div class="modal fade" id="deleteLogModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Confirm delete') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure you want to delete this log?') }}
                </div>
                <div class="modal-footer">
                    <form id="deleteLogForm" method="POST">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
