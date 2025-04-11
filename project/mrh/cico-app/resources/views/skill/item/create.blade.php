@extends('layouts.appskill')

@section('content')
    <div style="margin-top: 90px;"></div>
    <div class="col-md-12">
        <div class="container min-vh-100 mt-5 mb-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="border-color: #0d6efd;">
                        <h4 class="card-header text-center">Create Skill-Item</h4>
                        <div class="card-body">
                            <form method="post" action="{{ route('skill-item.processCreate') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-12 mx-auto">
                                        <div class="row">
                                            <div class="col">
                                                <label for="id-category" class="form-label">Category</label>
                                                <select name="category" class="form-select">
                                                    @foreach($skill_categories as $skill_category)
                                                        <option value="{{ $skill_category->id }}">{{ $skill_category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="id-name" class="form-label">Name</label>
                                                <input id="id-name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="id-display_order" class="form-label">Display Order</label>
                                                <input type="number" min="-1000" max="1000" id="id-display_order" name="display_order" class="form-control @error('display_order') is-invalid @enderror" value="{{ old('display_order') ?? 0 }}"
                                                       required>
                                                @error('display_order')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="id-description">Description</label>
                                                <textarea id="id-description" name="description" maxlength="500" class="form-control @error('description') is-invalid @enderror" style="max-height: 200px;">{{ old('description') }}</textarea>
                                                @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="text-center mt-3">
                                            <a href="{{ route('skill-item.index') }}" class="btn btn-secondary">Cancel</a>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.menubar')
@endsection
