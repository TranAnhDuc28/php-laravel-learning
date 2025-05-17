@extends('layouts.app')

@section('title', __('Create Employee | Human Resources'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Create Employee'"
                :breadcrumbs="[
                   ['label' => 'Human Resources', 'url' => null],
                   ['label' => 'Create Employee', 'url' => route('project.showProjectList')],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-12 col-md-6">
                                        <label for="id-name" class="form-label">{{ __('Full Name') }} (*)</label>
                                        <input type="text" id="id-full-name" name="full_name" class="form-control @error('name') is-invalid @enderror" value="{{ old('full_name') }}">
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-department" class="form-label">{{ __('Working department') }}</label>
                                        <select id="id-department" name="department_id" class="form-select @error('department_id') is-invalid @enderror">
                                            <option value="">-</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" @selected(old('department_id') == $department->id)>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-name" class="form-label">{{ __('Job position') }}</label>
                                        <input type="text" id="id-job-position" name="job_position" class="form-control @error('job_position') is-invalid @enderror" value="{{ old('job_position') }}">
                                        @error('job_position')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-api-username" class="form-label">{{ __('Email') }} (*)</label>
                                        <input type="text" id="id-api-username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}">
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-password" class="form-label">{{ __('Password') }} (*)</label>
                                        <input type="password" id="id-password" name="password" class="form-control @error('password')is-invalid @enderror show-password" value="{{ old('password', '12345678') }}">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="id-note" class="form-label">{{ __('Note') }}</label>
                                        <textarea id="id-note" name="note" rows="3" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                                        @error('note')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="button" id="save-employee" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
