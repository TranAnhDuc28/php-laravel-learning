<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title')</title>
</head>
<body class="bg-light">
<div class="container">
    <div class="row vh-100 align-items-center">
        <div class="col text-center">
            <div>@yield('message'): @yield('code')</div>
            <div>@yield('content')</div>
            <div><a href="{{ route('pages.dashboard') }}">{{ __('Home') }}</a></div>
        </div>
    </div>
</div>
</body>
</html>
