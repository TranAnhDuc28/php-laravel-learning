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



        </div>
    </div>
@endsection
