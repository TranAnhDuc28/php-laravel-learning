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

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{ __('Full name') }}</th>
                                        <td>{{ Auth::user()->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Email') }}</th>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Working department') }}</th>
                                        <td>{{ Auth::user()->department->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Position') }}</th>
                                        <td>{{ Auth::user()->position }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ __('Join Date') }}</th>
                                        <td>{{ Auth::user()->join_date }}</td>
                                    </tr>
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


