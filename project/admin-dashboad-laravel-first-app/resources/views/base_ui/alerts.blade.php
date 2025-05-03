@extends('app')

@section('title', 'Alerts')

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Alerts'"
                :breadcrumbs="[
                   ['label' => 'Base UI', 'url' => route('baseUi.notifications')],
                   ['label' => 'Alerts', 'url' => null]
                ]"
            />
        </div>
    </div>
@endsection
