@extends('layouts.app')

@section('title', __('Change Password'))

@section('content')
    <div class="page-content">
        <div class="container-fluid h-100">
            <x-breadcrumb
                :title="__('Change Password')"
                :breadcrumbs="[
                   ['label' => Auth::user()->full_name, 'url' => null],
                   ['label' => __('Change Password'), 'url' => route('auth.showChangePassword')],
                ]"
            />

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-8 mx-auto my-3">
                                    <form method="POST" action="{{ route('auth.processChangePassword') }}">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @elseif (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        <div class="row">
                                            <label for="id-current_password" class="col-form-label col-md-3">{{ __('Current Password') }} <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="password" id="id-current_password" name="current_password"
                                                       class="form-control @error('current_password') is-invalid @enderror show-password">
                                                @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="id-new_password" class="col-form-label col-md-3">{{ __('New Password') }} <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="password" id="id-new_password" name="new_password"
                                                       class="form-control @error('new_password') is-invalid @enderror show-password">
                                                @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <label for="id-new_password_confirmation" class="col-form-label col-md-3">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                                            <div class="col-md-9">
                                                <input type="password" id="id-new_password_confirmation" name="new_password_confirmation" class="form-control show-password">
                                            </div>
                                        </div>

                                        <div class="text-end mt-3">
                                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


