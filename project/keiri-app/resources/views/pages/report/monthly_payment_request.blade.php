@php use Illuminate\Support\Carbon; @endphp
@extends('layouts.app')

@section('title', __('Monthly Payment Request | Report'))
@push('head_css')
    <style>
        .table > :not(:first-child) {
            border-top-width: 0;
        }

        div.dt-scroll-body table thead tr:last-child th {
            border-bottom: 0 !important;
        }
    </style>
@endpush

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Monthly Payment Request'"
                :breadcrumbs="[
                   ['label' => 'Report', 'url' => null],
                   ['label' => 'Monthly Payment Request', 'url' => route('report.showMonthlyPaymentRequest')],
                ]"
            />

            <div class="row mb-3">
                <div class="row gap-3 p-0 justify-content-end align-items-center">
                    <div class="col-auto d-flex gap-3 align-items-center p-0">
                        <form action="{{ route('report.generateDataMonthlyPaymentRequest') }}" method="GET" class="w-100" id="term-form">
                            <div class="d-flex gap-2 align-items-center">
                                <label for="start-month" class="form-label mb-0 text-nowrap">{{ __('Start month') }}</label>
                                <select class="form-select" name="start_month" id="start-month" aria-label="Start month">
                                    <option value="" @selected($startMonth == null)>-</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}" @selected($month == request()->get('start_month'))>{{ Carbon::create()->month($month)->format('F') }}</option>
                                    @endfor
                                </select>

                                <label for="end-month" class="form-label mb-0">to</label>
                                <select class="form-select" name="end_month" id="end-month" aria-label="End month" disabled>
                                    <option value="" @selected($endMonth == null)>-</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}" @selected($month == request()->get('end_month'))>{{ Carbon::create()->month($month)->format('F') }}</option>
                                    @endfor
                                </select>

                                <label for="year" class="form-label mb-0">year</label>
                                <select class="form-select" name="year" id="year" aria-label="Year">
                                    @php
                                        $currentYear = Carbon::now()->get('year');
                                    @endphp
                                    @for($year = 2024; $year <= $currentYear; $year++)
                                        <option value="{{ $year }}" @selected($year == (request()->get('year') ?? $currentYear))>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-auto d-flex gap-2 p-0">
                        <button class="btn btn-outline-secondary" id="update-preview-report">
                            <i class="ri-refresh-line label-icon align-middle me-1"></i> {{ __('Update') }}
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-download label-icon align-middle me-1"></i> {{ __('Export') }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    {{-- Method 1. --}}
                    {{--                    @if($monthReports && count($monthReports) > 0)--}}
                    {{--                        <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-primary mb-3" role="tablist">--}}
                    {{--                            @foreach($monthReports as $monthReport)--}}
                    {{--                                <li class="nav-item">--}}
                    {{--                                    <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" href="#tab{{ $monthReport }}" role="tab">--}}
                    {{--                                        {{ $monthReport }}--}}
                    {{--                                    </a>--}}
                    {{--                                </li>--}}
                    {{--                            @endforeach--}}
                    {{--                        </ul>--}}
                    {{--                        <div class="tab-content">--}}
                    {{--                            @foreach($monthReports as $monthReport)--}}
                    {{--                                <div class="tab-pane fade @if($loop->first) show active @endif" id="tab{{ $monthReport }}" role="tabpanel">--}}
                    {{--                                    <div class="table-responsive">--}}
                    {{--                                        <table class="table table-sm table-bordered text-wrap report-monthly_payment_request">--}}
                    {{--                                            <thead class="text-center align-middle text-nowrap">--}}
                    {{--                                            <tr>--}}
                    {{--                                                <th>{{ __('Employee name') }}</th>--}}
                    {{--                                                <th>{{ __('Rank') }}</th>--}}
                    {{--                                                <th>{{ __('Category') }}</th>--}}
                    {{--                                                <th data-bs-toggle="tooltip" data-bs-title="{{ __('(Top: Monthly Rate, Bottom: Hourly Rate)') }}">--}}
                    {{--                                                    {{ __('Contract Unit Price') }}--}}
                    {{--                                                </th>--}}
                    {{--                                                <th>{{ __('Overtime work') }} (3)</th>--}}
                    {{--                                                <th>{{ __('Job content') }}</th>--}}
                    {{--                                                <th>{{ __('Total') }} <br> (1)+(2)+(3)</th>--}}
                    {{--                                            </tr>--}}
                    {{--                                            </thead>--}}
                    {{--                                            <tbody>--}}
                    {{--                                            @if(isset($dataReports[$monthReport]) && count($dataReports[$monthReport]) > 0)--}}
                    {{--                                                @foreach($dataReports[$monthReport] as $dataReport)--}}
                    {{--                                                    <tr>--}}
                    {{--                                                        <td rowspan="2">{{ $dataReport['employee_name'] }}</td>--}}
                    {{--                                                        <td rowspan="2">{{ $dataReport['rank'] }}</td>--}}
                    {{--                                                        <th scope="row">{{ __('Monthly Unit Price') }} (1)</th>--}}
                    {{--                                                        <td>{{ $dataReport['contract_unit_price'] }}</td>--}}
                    {{--                                                        <td rowspan="2">{{ $dataReport['monthly_data']['overtime_work'] }}</td>--}}
                    {{--                                                        <td rowspan="2">{{ implode(', ', $dataReport['job_content']) }}</td>--}}
                    {{--                                                        <td rowspan="2">{{ $dataReport['monthly_data']['total'] }}</td>--}}
                    {{--                                                    </tr>--}}
                    {{--                                                    <tr>--}}
                    {{--                                                        <th scope="row">{{ __('Regular Overtime') }} (2)</th>--}}
                    {{--                                                        <td>{{ $dataReport['monthly_data']['regular_overtime'] }}</td>--}}
                    {{--                                                    </tr>--}}
                    {{--                                                @endforeach--}}
                    {{--                                            @else--}}
                    {{--                                                <tr>--}}
                    {{--                                                    <td rowspan="2"></td>--}}
                    {{--                                                    <td rowspan="2"></td>--}}
                    {{--                                                    <th scope="row">{{ __('Monthly Unit Price') }} (1)</th>--}}
                    {{--                                                    <td></td>--}}
                    {{--                                                    <td rowspan="2"></td>--}}
                    {{--                                                    <td rowspan="2"></td>--}}
                    {{--                                                    <td rowspan="2"></td>--}}
                    {{--                                                </tr>--}}
                    {{--                                                <tr>--}}
                    {{--                                                    <th scope="row">{{ __('Regular Overtime') }} (2)</th>--}}
                    {{--                                                    <td></td>--}}
                    {{--                                                </tr>--}}
                    {{--                                            @endif--}}
                    {{--                                            </tbody>--}}
                    {{--                                        </table>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            @endforeach--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}

                    {{-- Method 2. --}}
                    @if($monthReports && count($monthReports) > 0)
                        <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-primary mb-3" role="tablist">
                            @foreach($monthReports as $monthReport)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" href="#tab{{ $monthReport }}" role="tab">
                                        {{ $monthReport }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach($monthReports as $monthReport)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="tab{{ $monthReport }}" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-wrap report-monthly_payment_request">
                                            <thead class="text-center align-middle text-nowrap">
                                            <tr>
                                                <th rowspan="2" class="text-center">{{ __('Employee name') }}</th>
                                                <th rowspan="2" class="text-center">{{ __('Rank') }}</th>
                                                <th colspan="2" class="text-center">{{ __('Contract unit price') }}</th>
                                                <th rowspan="2" class="text-center">{{ __('Overtime work') }} (3)</th>
{{--                                                <th rowspan="2" class="text-center">{{ __('Project name') }}</th>--}}
                                                <th rowspan="2" class="text-center">{{ __('Job content') }}</th>
{{--                                                <th colspan="3" class="text-center">{{ __('Project assign') }}</th>--}}
                                                <th rowspan="2" class="text-center">{{ __('Total') }} <br></th>
                                            </tr>
                                            <tr>
                                                <th class="text-center">{{ __('Monthly unit price') }} (1)</th>
                                                <th class="text-center">{{ __('Regular overtime') }} (2)</th>
{{--                                                <th class="text-center">{{ __('Term') }}</th>--}}
{{--                                                <th class="text-center">{{ __('Effort') }}</th>--}}
{{--                                                <th class="text-center">{{ __('Worked days') }}</th>--}}
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($dataReports[$monthReport]) && count($dataReports[$monthReport]) > 0)
                                                @foreach($dataReports[$monthReport] as $dataReport)
                                                    <tr>
                                                        <td class="text-nowrap">{{ $dataReport['employee_name'] }}</td>
                                                        <td>{{ $dataReport['rank'] }}</td>
                                                        <td>{{ $dataReport['contract_unit_price'] }}</td>
                                                        <td>{{ $dataReport['monthly_data']['overtime_work'] }}</td>
                                                        <td>{{ $dataReport['monthly_data']['regular_overtime'] }}</td>
{{--                                                        <td>--}}
{{--                                                            @foreach($dataReport['projects'] as $project)--}}
{{--                                                                <div class="m-0 p-0 text-nowrap">--}}
{{--                                                                    <span class="badge-dot badge-dot-dark"></span><span>{{ $project['project_name'] }}</span><br>--}}
{{--                                                                </div>--}}
{{--                                                            @endforeach--}}
{{--                                                        </td>--}}
                                                        <td>{{ implode(', ', $dataReport['job_content']) }}</td>
{{--                                                        <td  style="width: 200px">--}}
{{--                                                            @foreach($dataReport['projects'] as $project)--}}
{{--                                                                @foreach($project['project_assign_log_details'] as $projectAssignLogDetail)--}}
{{--                                                                    <div class="m-0 p-0">--}}
{{--                                                                        <strong>SD</strong>: <span>{{ $projectAssignLogDetail['start_date'] }}</span> | <strong>ED</strong>: <span>{{ $projectAssignLogDetail['end_date'] }}</span>--}}
{{--                                                                    </div>--}}
{{--                                                                @endforeach--}}
{{--                                                            @endforeach--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            @foreach($dataReport['projects'] as $project)--}}
{{--                                                                @foreach($project['project_assign_log_details'] as $projectAssignLogDetail)--}}
{{--                                                                    {{ $projectAssignLogDetail['effort_percentage'] }} <br>--}}
{{--                                                                @endforeach--}}
{{--                                                            @endforeach--}}
{{--                                                        </td>--}}
{{--                                                        <td>--}}
{{--                                                            @foreach($dataReport['projects'] as $project)--}}
{{--                                                                @foreach($project['project_assign_log_details'] as $projectAssignLogDetail)--}}
{{--                                                                    {{ $projectAssignLogDetail['worked_days'] }} <br>--}}
{{--                                                                @endforeach--}}
{{--                                                            @endforeach--}}
{{--                                                        </td>--}}
                                                        <td>{{ $dataReport['monthly_data']['total'] }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

@push('body_js')
    <script>
        const urlExportMonthlyPaymentRequest = "{{ route('report.exportMonthlyPaymentRequest') }}";
        const urlUpdateDataMonthlyPaymentRequest = "";
    </script>
@endpush
