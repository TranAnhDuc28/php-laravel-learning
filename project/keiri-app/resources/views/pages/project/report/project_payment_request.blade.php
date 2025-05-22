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

            <div class="mb-3 d-flex justify-content-end">
                <div>
                    <a href="{{ route('project.report.exportProjectPaymentRequest') }}" class="btn btn-outline-primary">Export</a>
                </div>

                <div class="d-flex gap-3">

                </div>
            </div>

            <div class="card mt-0">
                <div class="card-body">

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
