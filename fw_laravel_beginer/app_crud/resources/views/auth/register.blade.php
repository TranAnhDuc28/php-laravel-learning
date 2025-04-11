@extends('common.layout')

@section('title')
    Register
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm password</label>
            <input type="password" id="password" class="form-control" name="password_confirmation">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection

