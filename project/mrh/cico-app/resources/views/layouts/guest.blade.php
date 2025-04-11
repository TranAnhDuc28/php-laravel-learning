<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/common.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
{{--        <script src="{{ asset('js/common.js') }}"></script>--}}
        <title>{{ config('app.name', 'BIP') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
{{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="container min-vh-100 d-flex align-items-center">
{{--        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">--}}
{{--            <div>--}}
{{--                <a href="/">--}}
{{--                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--                </a>--}}
{{--            </div>--}}

{{--            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">--}}
            <div class="row">
                {{ $slot }}
            </div>
        </div>
{{--        <x-cookie-consent />--}}
        <!-- Footer -->
        @include('layouts.footer')
    </body>
</html>
