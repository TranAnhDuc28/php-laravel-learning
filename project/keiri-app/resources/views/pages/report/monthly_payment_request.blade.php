@extends('layouts.app')

@section('title', __('Monthly Payment Request | Report'))

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
                        <form action="#" class="w-100">
                            <div class="d-flex gap-2 align-items-center">
                                <label for="start-month" class="form-label mb-0 text-nowrap">{{ __('Start date') }}</label>
                                <select class="form-select" name="start_month" id="start-month" aria-label="Start month">
                                    <option value="">-</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}">{{ \Illuminate\Support\Carbon::create()->month($month)->format('F') }}</option>
                                    @endfor
                                </select>

                                <label for="end-month" class="form-label mb-0">to</label>
                                <select class="form-select" name="end_month" id="end-month" aria-label="End month" disabled>
                                    <option value="">-</option>
                                    @for($month = 1; $month <= 12; $month++)
                                        <option value="{{ $month }}">{{ \Illuminate\Support\Carbon::create()->month($month)->format('F') }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-auto d-flex gap-2 p-0">
                        <button class="btn btn-outline-secondary">
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
                    <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-primary mb-3" role="tablist">
                        @for($i = 1; $i <= 12; $i++)
                            <li class="nav-item">
                                <a class="nav-link @if($i == 1) active @endif" data-bs-toggle="tab" href="#tab{{ $i }}" role="tab">
                                    01/{{ $i < 10 ? "0{$i}" : $i }}/2024
                                </a>
                            </li>
                        @endfor
                    </ul>
                    <div class="tab-content">
                        @for($i = 1; $i <= 12; $i++)
                            <div class="tab-pane fade @if($i == 1) show active @endif" id="tab{{ $i }}" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table table-bordered text-wrap">
                                        <thead class="text-center align-middle text-nowrap">
                                        <tr>
                                            <th>{{ __('Employee name') }}</th>
                                            <th>{{ __('Rank') }}</th>
                                            <th>{{ __('Category') }}</th>
                                            <th data-bs-toggle="tooltip" data-bs-title="{{ __('(Top: Monthly Rate, Bottom: Hourly Rate)') }}">
                                                {{ __('Contract Unit Price') }}
                                            </th>
                                            <th>{{ __('Overtime work') }} (3)</th>
                                            <th>{{ __('Job content') }}</th>
                                            <th>{{ __('Total') }} <br> (1)+(2)+(3)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @for($j = 0; $j < 3; $j++)
                                            <tr>
                                                <td rowspan="2">Nhân viên {{ $j + 1 }} (Tab {{ $i }})</td>
                                                <td rowspan="2">Cấp bậc {{ $j + 1 }}</td>
                                                <th scope="row">{{ __('Monthly Unit Price') }} (1)</th>
                                                <td>1000</td>
                                                <td rowspan="2">Giờ làm thêm {{ $j + 1 }}</td>
                                                <td rowspan="2">Nội dung công việc {{ $j + 1 }}</td>
                                                <td rowspan="2">Tổng {{ $j + 1 }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">{{ __('Regular Overtime') }} (2)</th>
                                                <td>200</td>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endfor
                    </div>
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
