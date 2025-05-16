@extends('layouts.app_unauth')

@section('title', 'Sign In')

@section('content')
<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <div class="d-flex align-items-center justify-content-center logo mt-3">
                                    <img src="{{ asset('build/images/logo-full.png') }}" alt="Logo" class="ms-2" height="60"/>
                                </div>
                                <div class="pb-2 mt-3">
                                    <h5 class="card-title text-center text-primary fs-4">{{ __('Login') }}</h5>
                                </div>
                            </div>
                            <div class="p-2 mt-3">
                                <form action="{{ route('auth.processLogin') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('email', '') }}" id="username" name="email" placeholder="Enter username" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password <span class="text-danger">*</span></label>
                                        <div class="position-relative auth-pass-input-group mb-3">
                                            <input type="password" name="password" placeholder="Enter password" id="password-input" class="form-control password-input pe-5 @error('password') is-invalid @enderror">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon">
                                                <i class="ri-eye-fill align-middle"></i>
                                            </button>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit">Sign In</button>
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

@push('body_js')
    <script>
        Array.from(document.querySelectorAll("form .auth-pass-input-group")).forEach(function (item) {
            Array.from(item.querySelectorAll(".password-addon")).forEach(function (subitem) {
                subitem.addEventListener("click", function () {
                    let passwordInput = item.querySelector(".password-input");
                    if (passwordInput.type === "password") {
                        passwordInput.type = "text";
                    } else {
                        passwordInput.type = "password";
                    }
                });
            });
        });
    </script>
@endpush

