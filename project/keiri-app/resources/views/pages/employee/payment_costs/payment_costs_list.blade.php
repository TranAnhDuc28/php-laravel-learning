@extends('layouts.app')

@section('title', __('Payment Costs | Human Resources'))

@section('content')
    <div class="page-content">
        <div class="container-fluid h-100">
            <x-breadcrumb
                :title="'Payment Costs List'"
                :breadcrumbs="[
                   ['label' => 'Human Resources', 'url' => null],
                   ['label' => 'Payment Costs List', 'url' => route('employee.showEmployeePaymentCosts')],
                ]"
            />



        </div>
    </div>
@endsection
