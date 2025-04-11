<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{ $hello }}
    {!! $hello !!}

    {{--  If Statements  --}}

    @if (count($records) === 1)
        I have one record!
    @elseif (count($records) > 1)
        I have multiple records!
    @else
        I don't have any records!
    @endif

<br><br>

    @unless (Auth::check())
        You are not signed in.
    @endunless

    @isset($records)
        // $records is defined and is not null...
    @endisset

    @empty($records)
        // $records is "empty"...
    @endempty

<br><br>

    {{--  Authentication Directives  --}}
    @auth
        // The user is authenticated...
    @endauth

    @guest
        // The user is not authenticated...
    @endguest

    @auth('admin')
        // The user is authenticated...
    @endauth

    @guest('admin')
        // The user is not authenticated...
    @endguest

<br>
<br>

    {{--  Session Directives  --}}
    @session('status')
    <div class="p-4 bg-green-100">
        {{ $value }}
    </div>
    @endsession
</body>
</html>
