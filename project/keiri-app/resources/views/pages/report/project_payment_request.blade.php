@extends('layouts.app')

@section('title', __('Project Payment Request | Report'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Project'"
                :breadcrumbs="[
                   ['label' => 'Report', 'url' => null],
                   ['label' => 'Project Payment Request', 'url' => route('report.showProjectPaymentRequest')],
                ]"
            />

            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-9 mb-3">
                    <form action="{{ route('report.showProjectPaymentRequest') }}" method="GET" class="w-100" id="term-form">
                        <div class="d-flex gap-2 align-items-center w-100">
                            <label for="projects" class="form-label mb-0">{{ __('Projects') }}</label>
                            <select id="projects" class="form-select w-100 @error('projects') is-invalid @enderror" name="projects[]" multiple>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}" @selected(in_array($project->id, old('projects', [])))>{{ $project->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('projects')
                        <span class="choices-msg-error text-danger mt-1 d-block w-100" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @php
                            $projectsErrors = Illuminate\Support\Arr::flatten($errors->get('projects.*'));
                        @endphp
                        @if(!empty($projectsErrors))
                            <div class="msg-error text-danger mt-1" role="alert">
                                <strong>{{ __('Invalid projects:') }}</strong>
                                <ul class="mb-0">
                                    @foreach($projectsErrors as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-3 mb-3 d-flex gap-2 justify-content-end">
                    <button class="btn btn-outline-secondary" id="update-preview-report">
                        <i class="ri-refresh-line label-icon align-middle me-1"></i> {{ __('Update') }}
                    </button>
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-download label-icon align-middle me-1"></i> {{ __('Export') }}
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center align-middle">
                            <tr>
                                <th rowspan="2">{{ __('Project Name') }}</th>
                                <th rowspan="2">{{ __('Project outline') }}</th>
                                <th colspan="2">{{ __('Term') }}</th>
                                <th rowspan="2">{{ __('Assigned') }}</th>
                                <th>{{ __('Amount') }}</th>
                                <th rowspan="2">{{ __('Note') }}</th>
                            </tr>
                            <tr>
                                <th>{{ __('Start') }}</th>
                                <th>{{ __('End') }}</th>
                                <th>{{ __('(JPY)') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < 3; $i++)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endfor
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="row" colspan="5">{{ __('Total') }}</th>
                                <td colspan="2" class="text-start"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
