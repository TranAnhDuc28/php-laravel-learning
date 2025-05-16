@extends('layouts.app')

@section('title', __('General Timesheet | Timekeeping'))

@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <x-breadcrumb
                :title="'General Timesheet'"
                :breadcrumbs="[
                   ['label' => 'Timekeeping', 'url' => null],
                   ['label' => 'General Timesheet', 'url' => route('timesheet.timekeeping.showPageGeneralTimesheet')],
                ]"
            />



        </div>
    </div>
@endsection

