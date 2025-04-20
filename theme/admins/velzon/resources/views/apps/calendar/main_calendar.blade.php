@extends('app')

@section('title', 'Calendar')

@section('content')
    <div class="page-content">
        <div id="calendar-loading" class="text-center d-none">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div id="calendar"></div>
    </div>
@endsection

@push('body_js')
    <script>
        // Define all API routes
        window.calendarRoutes = {
            list: "{{ route('apps.calendar.events.list') }}",
            store: "{{ route('apps.calendar.events.store') }}",
            update: "{{ route('apps.calendar.events.update', ['event' => ':id']) }}",
            delete: "{{ route('apps.calendar.events.destroy', ['event' => ':id']) }}"
        };

        // Initial events from server
        window.initialEvents = {{ Illuminate\Support\Js::from($initialEvents) }};
    </script>

    {{-- Load required libraries --}}
    <script src="{{ asset('vendor/libs/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    {{-- Load calendar initialization --}}
    <script src="{{ asset('assets/js/pages/calendar.init.js') }}"></script>
@endpush 