@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <x-breadcrumb
                :title="'Dashboard'"
                :breadcrumbs="[
                   ['label' => 'Dashboard', 'url' => route('pages.dashboard')],
                ]"
            />

            <p class="fs-1">Dashboard</p>

        </div>
    </div>
@endsection

