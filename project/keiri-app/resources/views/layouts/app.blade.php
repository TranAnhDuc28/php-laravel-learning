<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite([
        'resources/js/layout.js',
        'resources/scss/bootstrap.scss',
        'resources/scss/icons.scss',
        'resources/scss/app.scss',
    ])

    <!-- Custom Css-->
    @stack('head_css')
    @stack('head_js')
</head>
<body>
<div id="layout-wrapper">
    @include('common.top_bar')
    @include('common.side_bar')
    <div id="main" class="main-content">
        @yield('content')
        @include('common.footer')
    </div>
</div>

@include('common.customizer')

@vite($viteEntries)

@stack('body_js')
</body>
</html>
