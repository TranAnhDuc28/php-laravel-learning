@extends('app')

@section('title', 'Colors')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Buttons'"
                :breadcrumbs="[
                   ['label' => 'Base UI', 'url' => route('baseUi.buttons')],
                   ['label' => 'Buttons', 'url' => null]
                ]"
            />


        </div>
    </div>
@endsection
