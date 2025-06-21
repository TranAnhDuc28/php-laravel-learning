@extends('layouts.app')

@section('title', __('Timekeeping data | Timekeeping'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <x-breadcrumb
                :title="'Timekeeping data'"
                :breadcrumbs="[
                   ['label' => 'Timekeeping', 'url' => null],
                   ['label' => 'Timekeeping data', 'url' => route('timesheet.timekeeping.showPageTimekeepingData')],
                ]"
            />

        </div>
    </div>
@endsection

