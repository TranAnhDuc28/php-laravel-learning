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




        </div>
    </div>
@endsection
