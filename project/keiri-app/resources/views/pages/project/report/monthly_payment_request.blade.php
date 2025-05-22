@extends('layouts.app')

@section('title', __('Report | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Project'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Report', 'url' => route('project.report.showProjectPaymentRequest')],
                ]"
            />

            <div class="card">
                <div class="card-body">
                    <div class="mb-3 d-flex justify-content-between">
                        <div>
                            <a href="{{ route('project.report.exportMonthlyPaymentRequest') }}" class="btn btn-outline-primary">Export</a>
                        </div>

                        <div class="d-flex gap-3">

                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered ">
                            <thead class="align-middle">
                            <tr>
                                <th>{{ __('Personnel name') }}</th>
                                <th>{{ __('Rank') }}</th>
                                <th>{{ __('Category') }}</th>
                                <th></th>
                                <th>{{ __('Overtime work') }}</th>
                                <th>{{ __('Job content') }}</th>
                                <th>{{ __('Total') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < 3; $i++)
                                    <tr>
                                        <td rowspan="2"></td>
                                        <td rowspan="2"></td>
                                        <td>{{ __('Monthly Fee') }}</td>
                                        <td></td>
                                        <td rowspan="2"></td>
                                        <td rowspan="2"></td>
                                        <td rowspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td>{{ __('Overtime') }}</td>
                                        <td></td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
