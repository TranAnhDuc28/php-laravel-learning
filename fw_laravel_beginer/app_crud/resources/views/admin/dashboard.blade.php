@extends('common.layout')

@section('title')
    Dashboard Admin
@endsection

@section('content')
    <h2>Hi, {{ Auth::user()->name }}</h2>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
@endsection

