@extends('layouts.app')

@section('title', __('Project Payment Request | Report'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Project'"
                :breadcrumbs="[
                   ['label' => 'Report', 'url' => null],
                   ['label' => 'Project Payment Request', 'url' => route('report.showProjectPaymentRequest')]
                ]"
            />

            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                    <div class="row">
                        <label for="status-project" class="col-sm-2 col-md-2 col-lg-2 col-xl-2 col-form-label mb-0">{{ __('Status') }}</label>
                        <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
                            <select id="status-project" class="form-select w-100">
                                <option value="">{{ __('All') }}</option>
                                <option value="{{ \App\Enums\ProjectStatus::IN_PROGRESS }}">{{ __('In progress') }}</option>
                                <option value="{{ \App\Enums\ProjectStatus::COMPLETED }}">{{ __('Completed') }}</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12 col-xl-12 mb-3">
                    <form action="{{ route('report.showProjectPaymentRequest') }}" method="GET" class="w-100" id="term-form">
                        <div class="row">
                            <label for="projects" class="col-md-1 col-lg-1 col-xl-1 col-form-label mb-0">{{ __('Projects') }}</label>
                            <div class="col-md-11 col-lg-11 col-xl-11">
                                <select id="projects" class="form-select w-100 @error('projects') is-invalid @enderror" name="projects[]" multiple>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" @selected(in_array($project->id, old('projects', [])))>{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </div>
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

                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-outline-secondary" id="btn-update-preview-project-payment-report">
                            <i class="ri-refresh-line label-icon align-middle me-1"></i> {{ __('Update') }}
                        </button>
                        <button class="btn btn-outline-primary" id="btn-export-project-payment-report">
                            <i class="bi bi-download label-icon align-middle me-1"></i> {{ __('Export') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="report-project_payment_request" class="table table-bordered">
                            <thead class="text-center align-middle">
                            <tr>
                                <th rowspan="2" class="text-center">{{ __('Project Name') }}</th>
                                <th rowspan="2" class="text-center">{{ __('Project outline') }}</th>
                                <th colspan="2" class="text-center">{{ __('Term') }}</th>
                                <th colspan="5" class="text-center">{{ __('Assigned') }}</th>
                                <th rowspan="2" class="text-center">{{ __('Amount') }} <br> (JPY)</th>
                                <th rowspan="2" class="text-center">{{ __('Note') }}</th>
                            </tr>
                            <tr>
                                <th class="text-center text-nowrap">{{ __('Start') }}</th>
                                <th class="text-center text-nowrap">{{ __('End') }}</th>
                                <th class="text-center text-nowrap">{{ __('Employee') }}</th>
                                <th class="text-center text-nowrap">{{ __('Join date') }}</th>
                                <th class="text-center text-nowrap">{{ __('Exit date') }}</th>
                                <th class="text-center">{{ __('Effort') }}</th>
                                <th class="text-center">{{ __('Worked days') }}</th>
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
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endfor
                            </tbody>
                            <tfoot>
                            <tr>
                                <th scope="row" colspan="11">{{ __('Total') }}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('body_js')
    <script>
        const projects = {{ \Illuminate\Support\Js::from($projects) }};
    </script>
@endpush
