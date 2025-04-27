<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Laravel Admin & Dashboard Template</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('build/images/favicon.ico') }}">

    @vite('resources/js/layout.js')

    @vite(['resources/scss/bootstrap.scss', 'resources/scss/icons.scss', 'resources/scss/app.scss'])

    <!-- Custom Css-->
    @stack('head_css')
    @stack('head_js')
</head>
<body>
<div id="layout-wrapper">
    @include('common.header')
    @include('common.remove_notification_modal')
    @include('common.menu')
    <div id="main" class="main-content">
        @yield('content')
        @include('common.footer')
    </div>
</div>
<!--start back-to-top-->
<button class="btn btn-danger btn-icon" id="back-to-top">
    <i class="ri-arrow-up-line"></i>
</button>
<!--end back-to-top-->

<!--preloader-->
<div id="preloader">
    <div id="status">
        <div class="spinner-border text-primary avatar-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

<div class="customizer-setting d-none d-md-block">
    <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
         data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
        <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
    </div>
</div>

@include('common.theme_settings')

{{-- JAVASCRIPT COMMON --}}
<script type='text/javascript' src="{{ asset('build/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('build/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('build/libs/node-waves/dist/waves.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('build/libs/feather-icons/dist/feather.min.js') }}"></script>
{{--<script type='text/javascript' src="{{ asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>--}}

@stack('body_js')

{{-- App js --}}
@vite(['resources/js/main.js'])

</body>
</html>
