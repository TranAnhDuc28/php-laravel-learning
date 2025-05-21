@extends('layouts.app')

@section('title', __('Profile'))

@section('content')
    <div class="page-content">
        <div class="container-fluid h-100">
            <x-breadcrumb
                :title="__('Profile')"
                :breadcrumbs="[
                   ['label' => Auth::user()->full_name, 'url' => null],
                   ['label' => __('Profile'), 'url' => route('auth.showProfile')],
                ]"
            />



        </div>
    </div>
@endsection


