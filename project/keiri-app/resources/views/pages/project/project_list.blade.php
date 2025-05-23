@extends('layouts.app')

@section('title', __('Project List | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Project'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Project List', 'url' => route('project.showProjectList')],
                ]"
            />

            <div class="row h-100">
                <div class="col-lg-12 h-100">
                    <div class="card h-100">
                        <div class="card-body h-100">
                            <div class="table-responsive h-100">
                                <table id="project_list" class="table table-striped nowrap w-100 h-100">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Project code') }}</th>
                                        <th>{{ __('Project name') }}</th>
                                        <th>{{ __('Project start date') }}</th>
                                        <th>{{ __('Project end date') }}</th>
                                        <th>{{ __('Phase') }}</th>
                                        <th>{{ __('Priority') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Project outline') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projects as $project)
                                        @php
                                            $priorityClassStyle = 'badge bg-secondary';
                                            $priorityLabel = 'Medium';
                                            if ($project->priority === \App\Enums\ProjectPriority::HIGH) {
                                                $priorityClassStyle = 'badge bg-danger';
                                                $priorityLabel = 'High';
                                            } else if($project->priority === \App\Enums\ProjectPriority::LOW){
                                                $priorityClassStyle = 'badge bg-info';
                                                $priorityLabel = 'Low';
                                            }

                                            $statusClassStyle = 'badge bg-secondary-subtle text-secondary';
                                            $statusLabel = 'Not started';
                                            if ($project->status === \App\Enums\ProjectStatus::IN_PROGRESS) {
                                                $statusClassStyle = 'badge bg-warning-subtle text-warning';
                                                $statusLabel = 'In progress';
                                            } else if ($project->status === \App\Enums\ProjectStatus::COMPLETED) {
                                                $statusClassStyle = 'badge bg-success-subtle text-success';
                                                $statusLabel = 'Completed';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('project.showUpdateProject', ['projectId' => $project->id]) }}" class="text-decoration-underline">{{ $project->project_code }}</a>
                                            </td>
                                            <td>
                                                <a href="{{ route('project.showUpdateProject', ['projectId' => $project->id]) }}" class="text-decoration-underline">{{ $project->project_name }}</a>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($project->project_start_date)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($project->project_end_date)->format('d-m-Y') }}</td>
                                            <td>{{ $project->phase }}</td>
                                            <td>
                                                <span class="{{ $priorityClassStyle }} fs-12">{{ $priorityLabel }}</span>
                                            </td>
                                            <td>
                                                <span class="{{ $statusClassStyle }} fs-12">{{ $statusLabel }}</span>
                                            </td>
                                            <td>{{ $project->note }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
