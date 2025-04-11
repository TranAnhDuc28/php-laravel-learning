<x-app-layout>
{{--        <div class="col-md-2">--}}
{{--            <!-- Menu Bar -->--}}
{{--            @include('layouts.menubar')--}}
{{--        </div>--}}
        <div class="col-md-12">
            <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5 align-items-center">
                {{--        <x-slot name="header">--}}
                {{--            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">--}}
                {{--                {{ __('Dashboard') }}--}}
                {{--            </h2>--}}
                {{--        </x-slot>--}}
                {{--        <div>quyen cua ban la {{ $userRole }}</div>--}}
                {{--        <div>Nút hiển thị {{ $buttonDisplay }}</div>--}}
                <div class="row">
                    <div class="container">
                        <div class="row justify-content-center text-center mt-4">
                            <div class="col-md-6">
                                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid mb-3" style="min-width: 15%; width: 20%">
                                <h3 class="text-white">BIP SYSTEMS VIETNAM CO., LTD.</h3>
                                <p class="text-white">Check-in and Check-out system</p>
                                @if(auth()->user()->isAd() || auth()->user()->isPu())
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <h6 class="text-white mt-1">Click on the <b>Menu</b> tab to use <b>System Administration!</b></h6>
                                    </div>
                                @else
                                    @if($checkInOut)
                                        <div>
                                            @if($checkInTime)
                                                <p>Today, You have checked in at: {{ \Carbon\Carbon::parse($checkInTime)->format('H:i') }}</p>
                                                @if($checkOutTime)
                                                    <p>You have checked out at: {{ \Carbon\Carbon::parse($checkOutTime)->format('H:i') }}</p>
                                                @endif
                                            @endif
                                        </div>
                                    @else
                                        <p>You have not checked in today!</p>
                                    @endif
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <h6 class="text-white mt-1">Please click the yellow button to</h6>
                                        <button id="checkButton"
                                                class="btn btn-warning"
                                                data-action="{{ $buttonDisplay }}"
                                                data-checkin-url="{{ route('check_in_out.store') }}"
                                                data-checkout-url="{{ route('check_in_out.update') }}">
                                            {{ $buttonDisplay === 'checkIn' ? 'Check In' : 'Check Out' }}
                                        </button>
                                    </div>
                                    <div>
                                        Please go to the top-right menu (<a href="{{ route('skill-user.show') }}" class="btn btn-success">Skill</a> menu) to test the new function.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--            <div class="col text-end">--}}
                    {{--                <a href="{{ route('check_in_out.create') }}" class="btn btn-primary">Add New Record</a>--}}
                    {{--            </div>--}}
                </div>
{{--                <div class="row mt-5">--}}
{{--                    <div class="d-flex align-items-center" style=" margin-top: -5px; margin-left: 1px; ">--}}
{{--                        <div class="text-white mt-1">--}}
{{--                            <h6>Please click the yellow button to </h6>--}}
{{--                        </div>--}}
{{--                        <div class="check-in-out-section ms-2">--}}
{{--                            <button id="checkButton"--}}
{{--                                    class="btn btn-warning"--}}
{{--                                    data-action="{{ $buttonDisplay }}"--}}
{{--                                    data-checkin-url="{{ route('check_in_out.store') }}"--}}
{{--                                    data-checkout-url="{{ route('check_in_out.update') }}">--}}
{{--                                {{ $buttonDisplay === 'checkIn' ? 'Check In' : 'Check Out' }}--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

                {{--        <div class="py-12">--}}
                {{--            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">--}}
                {{--                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">--}}
                {{--                    <div class="p-6 text-gray-900 dark:text-gray-100">--}}
                {{--                        {{ __("You're logged in!") }}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--            </div>--}}
                {{--        </div>--}}
            </div>
        </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
    <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
