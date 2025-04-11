@extends('layouts.appskill')

@section('content')
    <div style="margin-top: 90px;"></div>
    <div class="col-md-12">
        <div class="container min-vh-100 mt-5 mb-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card" style="border-color: #0d6efd;">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Skill-Item List</h6>
                            <a href="{{ route('skill-item.create') }}" class="btn btn-primary">Create new</a>
                        </div>
                        <div class="card-body">
                            <header class="mb-2"></header>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr class="text-center">
                                        <th style="width: 50px;">#</th>
                                        <th>Category</th>
                                        <th style="width: 120px;">Display Order</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th style="width: 170px;">Updated Time</th>
                                        <th style="width: 150px;">Action</th>
                                    </tr>
                                    @foreach($skill_items as $skill_item)
                                        <tr>
                                            <td class="text-end">{{ $loop->iteration }}</td>
                                            <td>{{ $skill_item->category?->name }}</td>
                                            <td class="text-end">{{ $skill_item->display_order }}</td>
                                            <td><a href="{{ route('skill-item.update', ['id' => $skill_item->id]) }}">{{ $skill_item->name }}</a></td>
                                            <td>{{ $skill_item->description }}</td>
                                            <td>{{ $skill_item->updated_at }}</td>
                                            <td>
                                                <form method="post" action="{{ route('skill-item.processDelete', ['id' => $skill_item->id]) }}"
                                                      onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                    @csrf
                                                    <a href="{{ route('skill-item.update', ['id' => $skill_item->id]) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                                    <button type="submit" class="btn btn-sm btn-danger me-2">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.menubar')
@endsection
