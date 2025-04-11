<x-app-layout>
    <style>
        .week-even {
            background-color: #b2eaa5;
        }

        .week-odd {
            background-color: #9aeacc;
        }

        /*.table-striped > tbody > tr.week-even:nth-of-type(even),*/
        /*.table-striped > tbody > tr.week-even:nth-of-type(odd),*/
        /*.table-striped > tbody > tr.week-odd:nth-of-type(even),*/
        /*.table-striped > tbody > tr.week-odd:nth-of-type(odd) {*/
        /*    background-color: inherit;*/
        /*}*/
    </style>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Check In/Out History</h6>
                <div class="d-flex gap-2">
                    <form action="{{ route('check_in_out.index') }}" method="GET" class="d-flex align-items-center">
                        <select name="month" class="form-select" onchange="this.form.submit()">
                            <option value="current" {{ $month === 'current' ? 'selected' : '' }}>
                                {{ now()->format('m/Y') }}
                            </option>
                            <option value="previous" {{ $month === 'previous' ? 'selected' : '' }}>
                                {{ now()->startOfMonth()->subMonth()->format('m/Y') }}
                            </option>
                        </select>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>In Lack Time</th>
                            <th>Out Lack Time</th>
                            <th>Over Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($checkInOuts as $record)
                            @php
                                $weekNumber = \Carbon\Carbon::parse($record->date)->weekOfYear;
                                $weekClass = $weekNumber % 2 === 0 ? 'week-even' : 'week-odd';
                            @endphp
                            <tr class="{{ $weekClass }}" style="--bs-table-bg: none;">
                                <td>{{ \Carbon\Carbon::parse($record->date)->format('l') }}</td>
                                <td>{{ \Carbon\Carbon::parse($record->date)->format('Y-m-d') }}</td>
                                <td class="{{ $record->leave_type == 0 ? "" : "text-primary" }}">{{ $record->leave_type == 0 ? "-" : config('leave_types.get_label')($record->leave_type) }}</td>
                                <td>{{ $record->check_in ? \Carbon\Carbon::parse($record->check_in)->format('H:i') : '-' }}</td>
                                <td>{{ $record->check_out ? \Carbon\Carbon::parse($record->check_out)->format('H:i') : '-' }}</td>
                                <td>{{ $record->in_lack_time ?? 0 }} minute(s)</td>
                                <td>{{ $record->out_lack_time ?? 0 }} minute(s)</td>
                                <td>{{ $record->over_time ?? 0 }} hour(s)</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No records found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

{{--                <div class="d-flex justify-content-center">--}}
{{--                    {{ $checkInOuts->links() }}--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
