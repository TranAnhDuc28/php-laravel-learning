@extends('app')

@section('title', 'Badges')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Badges'"
                :breadcrumbs="[
                   ['label' => 'Base UI', 'url' => route('baseUi.badges')],
                   ['label' => 'Badges', 'url' => null]
                ]"
            />


        </div>
    </div>
@endsection
