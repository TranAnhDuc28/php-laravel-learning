@extends('common.layout')

@section('title')
    Cập nhật: {{ $product->name }}
@endsection

@section('content')
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mt-3">
            <label for="category" class="form-label">Category</label>
            <select id="category" class="form-select" name="category">
                @foreach($categories as $id => $name)
                    <option value="{{ $id }}" @selected(old('category', $product->category_id) == $id)>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" class="form-control" name="name" value="{{ old('name', $product->name) }}" >
        </div>
        <div class="mt-3">
            <label for="image_path" class="form-label">Image</label>
            <input type="file" id="image_path" class="form-control" name="image_path">
            @if( $product->image_path && \Illuminate\Support\Facades\Storage::exists($product->image_path))
                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image_path) }}" alt="" width="100px">
            @endif
        </div>
        <div class="mt-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" class="form-control" name="price" value="{{ old('price', $product->price) }}" >
        </div>
        <div class="mt-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" class="form-control" name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mt-3">
            <label for="tags" class="form-label">Tags</label>
            <select id="tags" class="form-select" name="tags[]" multiple>
                @foreach($tags as $id => $name)
                    <option value="{{ $id }}" @selected(in_array($id, $productTags))>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        @foreach($product->galleries as $key => $item)
            <div class="mt-3">
                <label for="gallery_{{ $loop->iteration }}" class="form-label">Gallery {{ $loop->iteration }}</label>
                <input type="file" id="gallery_{{ $loop->iteration }}" class="form-control" name="galleries[{{ $item->id }}]">
                @if( $item->image_path && \Illuminate\Support\Facades\Storage::exists($item->image_path))
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image_path) }}" alt="" width="100px">
                @endif
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Danh sách</a>
    </form>
@endsection
