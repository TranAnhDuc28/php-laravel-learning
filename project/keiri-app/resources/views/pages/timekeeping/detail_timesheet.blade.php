@extends('layouts.app')

@section('title', __('Detailed Timesheet | Timekeeping'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <x-breadcrumb
                :title="'Detailed Timesheet'"
                :breadcrumbs="[
                   ['label' => 'Timekeeping', 'url' => null],
                   ['label' => 'Detailed Timesheet', 'url' => route('timesheet.timekeeping.showPageDetailedTimesheet')],
                ]"
            />


        </div>
    </div>
@endsection

