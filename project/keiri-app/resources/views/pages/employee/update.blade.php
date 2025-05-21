@extends('layouts.app')

@section('title', __('Update Employee | Human Resources'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Update Employee'"
                :breadcrumbs="[
                   ['label' => 'Human Resources', 'url' => null],
                   ['label' => 'Update Employee', 'url' => null],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('employee.processUpdateEmployee', ['id' => $employee->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-department" class="form-label">{{ __('Working department') }}</label>
                                        <select id="id-department" name="department_id" class="form-select @error('department_id') is-invalid @enderror">
                                            <option value="">-</option>
                                            @foreach($departments as $department)
                                                <option value="{{ $department->id }}" @selected(old('department_id', $employee->department_id) == $department->id)>
                                                    {{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-job_position" class="form-label">{{ __('Job position') }}</label>
                                        <input type="text" id="id-job_position" name="job_position"
                                               class="form-control @error('job_position') is-invalid @enderror"
                                               value="{{ old('job_position', $employee->job_position) }}">
                                        @error('job_position')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-full_name" class="form-label">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" id="id-full_name" name="full_name"
                                               class="form-control @error('full_name') is-invalid @enderror"
                                               value="{{ old('full_name', $employee->full_name) }}">
                                        @error('full_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-email" class="form-label">{{ __('Email') }} <span class="text-danger">*</span></label>
                                        <input type="email" id="id-email" name="email"
                                               class="form-control @error('email') is-invalid @enderror"
                                               value="{{ old('email', $employee->email) }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-join_date" class="form-label">{{ __('Join date') }}</label>
                                        <div class="input-group">
                                            <input type="text" id="id-join_date" name="join_date"
                                                   class="form-control @error('join_date') is-invalid @enderror"
                                                   value="{{ old('join_date', $employee->join_date) }}">
                                            <span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
                                        </div>
                                        @error('join_date')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 mb-3">
                                        <label for="id-status" class="form-label">{{ __('Status') }}</label>
                                        <select id="id-status" name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="{{ \App\Enums\UserStatus::ACTIVE }}" @selected($employee->status === \App\Enums\UserStatus::ACTIVE)>{{ __('Active') }}</option>
                                            <option value="{{ \App\Enums\UserStatus::INACTIVE }}" @selected($employee->status === \App\Enums\UserStatus::INACTIVE)>{{ __('Inactive') }}</option>
                                        </select>
                                        @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <label for="id-note" class="form-label">{{ __('Note') }}</label>
                                        <textarea id="id-note" name="note" rows="3" class="form-control @error('note') is-invalid @enderror">{{ old('note', $employee->note) }}</textarea>
                                        @error('note')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" id="btn-save-employee" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
