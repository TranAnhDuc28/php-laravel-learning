<x-app-layout>
    <style>
        .table-fixed-header {
            position: relative;
            width: 100%;
            overflow: auto;
            max-height: 80vh;
        }

        .table-fixed-header thead th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
            box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1); /* Tạo bóng nhẹ phía dưới */
        }

        .select-compact {
            /*width: auto;*/
            min-width: 150px;
            max-width: 250px;
            height: 30px;
            padding-top: 2px;
            padding-bottom: 2px;
        }

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
            <form method="GET" action="{{ route('check_in_out.list') }}" id="filterForm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Check In/Out History</h6>
                <div class="d-flex gap-2">
                    <select class="form-select select-compact" name="month" onchange="this.form.submit()">
                        @foreach($availableMonths as $value => $label)
                            <option value="{{ $value }}" {{ $selectedMonth == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <select class="form-select select-compact" name="user_id" onchange="this.form.submit()">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $selectedUserId == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-fixed-header">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>In</th>
                            <th>Out</th>
                            <th>Lack(M)</th>
                            <th>Unpaid</th>
                            <th>Paid Leave</th>
                            <th>Working Day</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $currentName = '';
                            $totalWorkingDays = 0;
                            $totalPaidLeave = 0;
                            $totalUnpaidLeave = 0;
                        @endphp
                        @forelse($checkInOuts as $record)
                            @php
                                $weekNumber = \Carbon\Carbon::parse($record->date)->weekOfYear;
                                $weekClass = $weekNumber % 2 === 0 ? 'week-even' : 'week-odd';
                            @endphp
                            @if($currentName != '' && $currentName != $record->user->name)
                                <tr class="table-info">
                                    <td colspan="2" class="text-end fw-bold">Total:</td>
                                    <td colspan="4"></td>
                                    <td class="fw-bold">{{ $totalUnpaidLeave }}</td>
                                    <td class="fw-bold">{{ $totalPaidLeave }}</td>
                                    <td class="fw-bold">{{ $totalWorkingDays }}</td>
                                </tr>
                                @php
                                    $totalWorkingDays = 0;
                                    $totalPaidLeave = 0;
                                    $totalUnpaidLeave = 0;
                                @endphp
                            @endif
                            <tr class="{{ $weekClass }}" style="--bs-table-bg: none;">
                                @php
                                    if (!$record->status) {
                                        $lack_time = 0;
                                        $unpaid_working = 0;
                                        $paid_leave = $record->paid_leave/8;
                                        $working_time = $record->official_working_hours == 0 ? 0 : ($record->over_time + $record->official_working_hours)*60/480;
                                    } else {
                                        if ($record->paid_leave != 0) {
                                            $lack_time = (8 - $record->paid_leave - $record->working_time) * 60;
                                            if ($lack_time > 0) {
                                                $unpaid_working = App\Helpers\CustomHelper::customRound($lack_time/60);
                                                $paid_leave = $record->paid_leave/8;
                                                $working_time = App\Helpers\CustomHelper::customRound(1 - $unpaid_working/8);
                                            } else {
                                                $lack_time = 0;
                                                $unpaid_working = 0;
                                                $paid_leave = $record->paid_leave/8;
                                                $working_time = 1 - $paid_leave;
                                            }
                                        } else {
                                            $lack_time = (8 - $record->working_time) * 60;
                                            if ($record->unpaid_leave == 8) {
                                                $unpaid_working = 1;
                                                $paid_leave = 0;
                                                $working_time = 0;
                                            } else {
                                                $lack_time = $lack_time < 0 ? 0 : $lack_time;
                                                $unpaid_working = App\Helpers\CustomHelper::customRound($lack_time/60);
                                                $paid_leave = 0;
                                                $working_time = App\Helpers\CustomHelper::customRound(1 - $unpaid_working/8);
                                            }
                                        }
                                    }
                                @endphp
                                <td>{{ \Carbon\Carbon::parse($record->date)->format('l') }}</td>
                                <td>{{ \Carbon\Carbon::parse($record->date)->format('Y-m-d') }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($record->check_in)->format('H:i') != '00:00' ? \Carbon\Carbon::parse($record->check_in)->format('H:i') : '-' }}</td>
                                <td>{{ isset($record->check_out) && \Carbon\Carbon::parse($record->check_out)->format('H:i') != '00:00'? \Carbon\Carbon::parse($record->check_out)->format('H:i') : '-' }}</td>
                                <td>{{ $lack_time }}</td>
                                <td>{{ App\Helpers\CustomHelper::customRound($unpaid_working/8) }}</td>
                                <td>{{ $paid_leave }} </td>
                                <td>{{ $working_time }} </td>
                            </tr>

                            @php
                                $currentName = $record->user->name;
                                $totalWorkingDays += $working_time;
                                $totalPaidLeave += $paid_leave;
                                $totalUnpaidLeave += App\Helpers\CustomHelper::customRound($unpaid_working * 60/480);
                            @endphp

                            @if($loop->last)
                                <tr class="table-info">
                                    <td colspan="2" class="text-end fw-bold">Total:</td>
                                    <td colspan="4"></td>
                                    <td class="fw-bold">{{ $totalUnpaidLeave }}</td>
                                    <td class="fw-bold">{{ $totalPaidLeave }}</td>
                                    <td class="fw-bold">{{ $totalWorkingDays }}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No records found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

{{--                <div class="d-flex justify-content-center">--}}
{{--                    {{ $checkInOuts->links() }}--}}
{{--                </div>--}}
            </div>
            </form>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
