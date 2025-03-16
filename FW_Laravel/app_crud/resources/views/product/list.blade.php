@extends('common.layout')

@section('title')
    Danh sách
@endsection

@section('content')
    <div class="my-3">
        <a class="btn btn-primary" href="{{ route('products.create') }}">Add</a>
    </div>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <table class="table table-striped table-responsive">
        <thead>
        <tr>
            <th>ID</th>
            <th>Category</th>
            <th>Name</th>
            <th>Image</th>
            <th>Price</th>
            <th>Tag</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    @if( $product->image_path && \Illuminate\Support\Facades\Storage::exists($product->image_path))
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image_path) }}" alt="" width="100px">
                    @else
                        <p>No image available</p>
                    @endif
                </td>
                <td>{{ number_format($product->price) }}</td>
                <td>
                    @foreach($product->tags as $tag)
                        <span class="badge text-bg-info">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td class="d-flex gap-3">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc không?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
