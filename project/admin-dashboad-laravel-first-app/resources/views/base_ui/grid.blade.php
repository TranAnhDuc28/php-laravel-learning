@extends('app')

@section('title', 'Grid')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Grid'"
                :breadcrumbs="[
                   ['label' => 'Base UI', 'url' => route('baseUi.grid')],
                   ['label' => 'Grid', 'url' => null]
                ]"
            />



        </div>
    </div>
@endsection
