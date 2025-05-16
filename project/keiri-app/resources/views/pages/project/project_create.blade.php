@extends('layouts.app')

@section('title', __('Create Project | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Create Project'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Create Project', 'url' => route('project.showCreateProjectForm')],
                ]"
            />



        </div>
    </div>
@endsection
