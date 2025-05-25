@extends('layouts.app')

@section('title', __('Project Assignment | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Project assignment'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Project assignment', 'url' => route('project.showProjectAssignment')],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="project_assign_list" class="table table-striped nowrap w-100">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{ __('Project Code') }}</th>
                                        <th>{{ __('Project Name') }}</th>
                                        <th>{{ __('Assign') }}</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projectAssignments as $projectAssignment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $projectAssignment->project_code }}</td>
                                            <td>{{ $projectAssignment->project_name }}</td>
                                            <td>
                                                <ul class="mb-0 ps-0">
                                                    @foreach($projectAssignment->users as $user)
                                                        <div class="m-0 p-0">{{ $user->full_name }}</div>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="align-content-center">
                                                <div class="d-flex gap-2 flex-wrap justify-content-center">
                                                    <a href="{{ route('project.showProjectAssignmentDetail', ['projectId' => $projectAssignment->id]) }}" class="text-decoration-underline">
                                                        {{ __('Detail') }}
                                                    </a>
                                                </div>
                                            </td>
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
