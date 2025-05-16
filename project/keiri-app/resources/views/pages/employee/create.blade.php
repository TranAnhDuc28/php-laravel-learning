@extends('layouts.app')

@section('title', __('Create Employee | Human Resources'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <x-breadcrumb
                :title="'Create Employee'"
                :breadcrumbs="[
                   ['label' => 'Human Resources', 'url' => null],
                   ['label' => 'Create Employee', 'url' => route('project.showProjectList')],
                ]"
            />



        </div>
    </div>
@endsection
