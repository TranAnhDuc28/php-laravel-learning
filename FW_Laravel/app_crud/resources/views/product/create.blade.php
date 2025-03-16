@extends('common.layout')

@section('title')
    Thêm mới
@endsection

@section('content')
    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" class="form-select" name="category">
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" @selected(old('category') == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" >
        </div>
        <div class="mt-3">
            <label for="image_path" class="form-label">Image</label>
            <input type="file" id="image_path" class="form-control" name="image_path">
        </div>
        <div class="mt-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" class="form-control" name="price" value="{{ old('price') }}" >
        </div>
        <div class="mt-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
        </div>

        <div class="mt-3">
            <label for="tags" class="form-label">Tags</label>
            <select id="tags" class="form-select" name="tags[]" multiple>
                @foreach($tags as $id => $name)
                    <option value="{{ $id }}" @if(old('tags')) @selected(in_array($id, old('tags'))) @endif>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <label for="gallery_1" class="form-label">Gallery 1</label>
            <input type="file" id="gallery_1" class="form-control" name="galleries[]">
        </div>

        <div class="mt-3">
            <label for="gallery_2" class="form-label">Gallery 2</label>
            <input type="file" id="gallery_2" class="form-control" name="galleries[]">
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Danh sách</a>
    </form>
@endsection
