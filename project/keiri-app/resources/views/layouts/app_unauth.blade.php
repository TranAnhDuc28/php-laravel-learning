<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite([
        'resources/scss/bootstrap.scss',
        'resources/scss/icons.scss',
        'resources/scss/app.scss',
        'resources/scss/app.scss',
    ])

    <!-- Custom Css-->
    @stack('head_css')
    @stack('head_js')
</head>
<body>

@yield('content')

@vite($viteEntries)
@stack('body_js')
</body>
</html>
