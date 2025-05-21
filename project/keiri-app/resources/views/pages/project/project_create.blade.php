@extends('layouts.app')

@section('title', __('Create Project | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Create Project'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Create Project', 'url' => route('project.showCreateProjectForm')],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('project.processCreateProject') }}">
                                @csrf
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="card-title fw-bold">{{ __('Project Information') }}</div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="switchUseExistingProject" name="use_existing_project">
                                        <label class="form-check-label" for="switchUseExistingProject">Use existing project.</label>
                                    </div>
                                </div>

                                {{-- Form project. --}}
                                <div class="ps-3 pe-3">
                                    {{-- Form select existing project. --}}
                                    <div class="form-select-existing-project mt-3 d-none">
                                        <label for="project_id" class="form-label">{{ __('Project Name') }} <span class="text-danger">*</span></label>
                                        <select id="project_id" name="project_id" class="form-select @error('project_id') is-invalid @enderror">
                                            <option value="">-</option>
                                            @foreach($projects as $project)
                                                <option value="{{ $project->project_code }}">{{ $project->project_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('project_id')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    {{-- Form create project. --}}
                                    <div class="form-create-project">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 mt-3">
                                                <label for="id-project-code" class="form-label">{{ __('Project Code') }} <span class="text-danger">*</span></label>
                                                <input type="text" id="id-project-code" name="project_code" class="form-control @error('project_code') is-invalid @enderror" value="{{ old('project_code') }}">
                                                @error('project_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-md-6 mt-3">
                                                <label for="id-project-name" class="form-label">{{ __('Project Name') }} <span class="text-danger">*</span></label>
                                                <input type="text" id="id-project-name" name="project_name" class="form-control @error('project_name') is-invalid @enderror" value="{{ old('project_name') }}">
                                                @error('project_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 mt-3">
                                                <label for="id-project-start-date" class="form-label">{{ __('Start date') }} <span class="text-danger">*</span></label>
                                                <div class="input-group @error('project_end_date') has-validation @enderror">
                                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                    <input type="text" id="id-project-start-date" name="project_start_date"
                                                           class="form-control flatpickr flatpickr-input @error('project_start_date') is-invalid @enderror"
                                                           value="{{ old('project_start_date') }}">
                                                    @error('project_start_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 mt-3">
                                                <label for="id-project-end-date" class="form-label">{{ __('End date') }} <span class="text-danger">*</span></label>
                                                <div class="input-group @error('project_end_date') has-validation @enderror">
                                                    <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                                    <input type="text" id="id-project-end-date" name="project_end_date"
                                                           class="form-control flatpickr flatpickr-input @error('project_end_date') is-invalid @enderror"
                                                           value="{{ old('project_end_date') }}">
                                                    @error('project_end_date')
                                                    <span class="invalid-feedback">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12">
                                                <label for="id-note" class="form-label">{{ __('Project outline') }}</label>
                                                <textarea id="id-note" name="note" rows="3" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                                @error('note')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 mt-3">
                                                <label for="id-phase" class="form-label">{{ __('Phase') }}</label>
                                                <input type="number" id="id-phase" name="phase" class="form-control @error('phase') is-invalid @enderror" value="{{ old('phase') }}">
                                                @error('phase')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-md-4 mt-3">
                                                <label for="id-priority" class="form-label">{{ __('Priority') }}</label>
                                                <select id="id-priority" name="priority" class="form-select @error('priority') is-invalid @enderror">
                                                    <option value="">-</option>
                                                    <option value="{{ \App\Enums\ProjectPriority::LOW }}" @selected(old('priority') === \App\Enums\ProjectPriority::LOW)>{{ __('Low') }}</option>
                                                    <option value="{{ \App\Enums\ProjectPriority::MEDIUM }}" @selected(old('priority') === \App\Enums\ProjectPriority::MEDIUM)>{{ __('Medium') }}</option>
                                                    <option value="{{ \App\Enums\ProjectPriority::HIGH }}" @selected(old('priority') === \App\Enums\ProjectPriority::HIGH)>{{ __('High') }}</option>
                                                </select>
                                                @error('priority')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-12 col-md-4 mt-3">
                                                <label for="id-project-status" class="form-label">{{ __('Status') }}</label>
                                                <select id="id-project-status" name="status" class="form-select @error('status') is-invalid @enderror">
                                                    <option value="">-</option>
                                                    <option value="{{ \App\Enums\ProjectStatus::NOT_STARTED}}" @selected(old('status') === \App\Enums\ProjectStatus::NOT_STARTED)>{{ __('Not started') }}</option>
                                                    <option value="{{ \App\Enums\ProjectStatus::IN_PROGRESS }}" @selected(old('status') === \App\Enums\ProjectStatus::IN_PROGRESS)>{{ __('In progress') }}</option>
                                                    <option value="{{ \App\Enums\ProjectStatus::COMPLETED }}" @selected(old('status') === \App\Enums\ProjectStatus::COMPLETED)>{{ __('Complete') }}</option>
                                                </select>
                                                @error('status')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Form project assign. --}}
                                <div class="card-title fw-bold mt-4">{{ __('Project Assignment') }}</div>

                                {{-- Form project assign. --}}
                                <div class="ps-3 pe-3">
                                    <div class="row">
                                        <div class="col-sm-12 mt-3">
                                            <label for="team-members" class="form-label">{{ __('Team members') }}</label>
                                            <select id="team-members" class="form-select @error('team_members') is-invalid @enderror" name="team_members[]" multiple>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}" @selected(in_array($user->id, old('team_members', [])))>{{ $user->full_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('team_members')
                                            <span class="choices-msg-error text-danger mt-1 d-block w-100" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                            @php
                                                $teamMembersErrors = Illuminate\Support\Arr::flatten($errors->get('team_members.*'));
                                            @endphp
                                            @if(!empty($teamMembersErrors))
                                                <div class="choices-msg-error text-danger mt-1" role="alert">
                                                    <strong>{{ __('Invalid team members:') }}</strong>
                                                    <ul class="mb-0">
                                                        @foreach($teamMembersErrors as $message)
                                                            <li>{{ $message }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                        <div id="team-members-form" class="col-sm-12 mt-3"></div>
                                    </div>
                                </div>

                                <div class="text-end ps-3 pe-3 mt-3">
                                    <button type="submit" id="btn-save-project" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

