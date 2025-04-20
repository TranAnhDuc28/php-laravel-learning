<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Laravel Admin & Dashboard Template</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    @stack('head_css')
    <!-- Layout config Js -->
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Custom Css-->
    <link href="{{ asset('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css"/>
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
<button onclick="scrollToTop()" class="btn btn-danger btn-icon" id="back-to-top">
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
<script type='text/javascript' src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

@stack('body_js')

{{-- App js --}}
<script type='text/javascript' src="{{ asset('assets/js/app.js') }}"></script>
<script type='text/javascript' src="{{ asset('vendor/js/app.js') }}"></script>
</body>
</html>
