@extends('layouts.app')

@section('title', 'Create Post')

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

    <form action="{{ route('post.store') }}" method="POST">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}">

        <label for="body">Body</label>
        <textarea type="text" name="body" id="body">{{ old('body') }}</textarea>

        <button type="submit">Create</button>
    </form>
@endsection
