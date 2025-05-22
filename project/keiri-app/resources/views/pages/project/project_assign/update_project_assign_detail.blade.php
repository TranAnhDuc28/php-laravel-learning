@extends('layouts.app')

@section('title', __('Update Project Member | Project'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Update project member'"
                :breadcrumbs="[
                   ['label' => 'Project', 'url' => null],
                   ['label' => 'Update project member', 'url' => null],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
