@extends('layouts.appskill')

@push('head_css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/datatables.min.css') }}"/>
    <style>
        .column-freeze {
            position: sticky;
            left: -1px;
        }
    </style>
@endpush

@section('content')
    <div style="margin-top: 90px;"></div>
    <div class="col-md-12">
        <div class="container min-vh-100 mt-5 mb-5 pb-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card" style="border-color: #0d6efd;">
                        <h4 class="card-header text-center">User Skill List</h4>
                        <div class="card-body">
                            <header class="mb-4"></header>
                            @if(count($skill_items) == 0)
                                <div>Have no Skill-Item. Please contact Admin to create it.</div>
                            @else
                                <div class="table-responsive">
                                    <table id="id-skill" class="table table-bordered w-100">
                                        <thead>
                                        <tr class="text-center text-nowrap">
                                            <th rowspan="2" class="align-middle column-freeze">User</th>
                                            @foreach($skill_categories as $skill_category)
                                                @if(count($skill_category->items) > 0)
                                                    @php
                                                        $colspan_prop = count($skill_category->items) > 1 ? ' colspan="' . count($skill_category->items) . '"' : '';
                                                        $tooltip_prop = $skill_category->description ? ' data-bs-toggle="tooltip" data-bs-title="' . $skill_category->description . '"' : '';
                                                    @endphp
                                                    <th class="text-center align-middle"{!! $colspan_prop !!}{!! $tooltip_prop !!}>{{ $skill_category->name }}</th>
                                                @endif
                                            @endforeach
                                            <th rowspan="2" class="align-middle" style="width: 170px;">Updated Time</th>
                                            <th rowspan="2" class="align-middle" style="width: 150px;">Action</th>
                                        </tr>
                                        <tr>
                                            @foreach($skill_items as $skill_item)
                                                @php
                                                    $tooltip_prop = $skill_item->description ? ' data-bs-toggle="tooltip" data-bs-title="' . $skill_item->description . '"' : '';
                                                @endphp
                                                <th class="align-middle" {!! $tooltip_prop !!} style="writing-mode: vertical-rl; white-space: nowrap;">{{ $skill_item->name }}</th>
                                            @endforeach
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($skill_data_by_users as $skill_data_by_user)
                                            <tr class="align-middle">
                                                <td class="text-nowrap column-freeze">{{ $skill_data_by_user[1] }}</td>
                                                @foreach($skill_data_by_user[3] as $skill_item_value)
                                                    <td class="text-center" style="background: {!! '#' . config('skill.values')[$skill_item_value??0][0] !!}">{{ $skill_item_value }}</td>
                                                @endforeach
                                                <td class="text-center text-nowrap">{{ $skill_data_by_user[2] }}</td>
                                                <td class="text-center text-nowrap">
                                                    <a href="{{ route('skill-user.edit', ['user_id'=>$skill_data_by_user[0]]) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                                                    <a href="{{ route('skill-user.export', ['user'=>$skill_data_by_user[0]]) }}" class="btn btn-sm btn-primary">Export</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-center mt-4">
                                    <a href="{{ route('skill-user.export', ['user'=>'all']) }}" class="btn btn-primary">Export Excel</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.menubar')
@endsection

@push('body_js')
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script>
        $(function () {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
        });
    </script>
@endpush

