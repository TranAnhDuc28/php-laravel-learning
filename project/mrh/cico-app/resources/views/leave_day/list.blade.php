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
    </style>
    <div class="min-vh-100 m-5 pt-5 pb-5">
        <div class="card">
            <form method="GET" action="{{ route('leave_days.list') }}" id="filterForm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Day-Off Management</h6>
                <div class="d-flex gap-2">
                    <select class="form-select select-compact" name="year" onchange="this.form.submit()">
                        @foreach($availableYears as $value => $label)
                            <option value="{{ $value }}" {{ $selectedYear == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    <select class="form-select select-compact" name="month" onchange="this.form.submit()">
                        @foreach($availableMonths as $value => $label)
                            <option value="{{ $value }}" {{ $selectedMonth == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
{{--                    <button type="button" class="btn btn-sm btn-secondary">Export To Excel</button>--}}
{{--                    <select class="form-select select-compact" name="month" onchange="this.form.submit()">--}}
{{--                        @foreach($availableMonths as $value => $label)--}}
{{--                            <option value="{{ $value }}" {{ $selectedMonth == $value ? 'selected' : '' }}>--}}
{{--                                {{ $label }}--}}
{{--                            </option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive table-fixed-header">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="số thứ tự">No</th>
                            <th data-bs-toggle="tooltip" data-bs-placement="top" title="tên nhân viên">Name</th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="số ngày phép còn lại của năm trước">phép còn lại của năm trước<p>A</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="số ngày phép chuyển từ năm trước">phép chuyển từ năm trước<p>B</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="số ngày phép được thêm tính theo năm làm việc">phép được thêm theo năm làm việc<p>C</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="nghỉ bù được nhận">nghỉ bù được nhận<p>N</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="số ngày nghỉ trong tháng">ngày nghỉ trong tháng<p>D=E+F+G+H+J</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="nghỉ phép">phép<p>E</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="nghỉ phép có kế hoạch">kế hoạch<p>F</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="nghỉ ứng phép">ứng<p>G</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="nghỉ không phép">không phép<p>H</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="nghỉ hưởng lương">hưởng lương<p>I</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="nghỉ bù">bù<p>J</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="số phép được hưởng tính đến cuối tháng">tổng phép hưởng<p>K=N+B+C+1</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="số phép đã nghỉ tính đến cuối tháng">tổng phép đã nghỉ<p>L=L(old)+E+F+G+J</p></th>
                            <th class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="số phép còn lại tính đến cuối tháng">tổng phép còn lại<p>M=K-L</p></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-skyblue-custom" style="--bs-table-bg: none;"><th colspan="16">Administration Department</th></tr>

                        @php
                            $adminCount = 1;
                            $itCount = 1;
                        @endphp

                        @forelse($checkInOuts as $record)
                            @if ($record->user->role == 2)
                            <tr>
                                <td class="text-center">{{ $adminCount++ }}</td>
                                <td>{{ $record->user->name }}</td>
                                <td class="text-center">{{ $record->days_off_to_june }}</td>
                                <td class="text-center">{{ $record->carried_days_off }}</td>
                                <td class="text-center">{{ $record->award_days_off }}</td>
{{--                                cột N--}}
                                <td class="text-center">{{ $record->compensatory_day_off }}</td>
{{--                                cột D--}}
                                <td class="text-center">{{ $record->pl_to_used_m + $record->plan_pl_to_used_m + $record->pl_in_advance_to_used_m + $record->un_pl_to_used_m + $record->compensatory_day_to_used_m}}</td>
                                {{--                                cột E--}}
                                <td class="text-center">{{ $record->pl_to_used_m }}</td>
                                {{--                                cột F--}}
                                <td class="text-center">{{ $record->plan_pl_to_used_m }}</td>
                                {{--                                cột G--}}
                                <td class="text-center">{{ $record->pl_in_advance_to_used_m }}</td>
                                {{--                                cột H--}}
                                <td class="text-center">{{ $record->un_pl_to_used_m }}</td>
                                {{--                                cột I--}}
                                <td class="text-center">{{ $record->sl_to_used_m }}</td>
                                {{--                                cột J--}}
                                <td class="text-center">{{ $record->compensatory_day_to_used_m }}</td>
{{--                                cột K--}}
                                <td class="text-center">{{ $record->all_pl_available_m }}</td>
{{--                                cột L--}}
                                <td class="text-center">{{ $record->all_pl_to_used_m }}</td>
{{--                                cột M--}}
                                <td class="text-center">{{ $record->all_pl_remain_to_use_m}}</td>
                            </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="16" class="text-center">No records found</td>
                            </tr>
                        @endforelse
                        <tr class="bg-skyblue-custom" style="--bs-table-bg: none;"><th colspan="16">IT Department</th></tr>
                        @forelse($checkInOuts as $record)
                            @if ($record->user->role == 1)
                                <tr>
                                    <td class="text-center">{{ $adminCount++ }}</td>
                                    <td>{{ $record->user->name }}</td>
                                    <td class="text-center">{{ $record->days_off_to_june }}</td>
                                    <td class="text-center">{{ $record->carried_days_off }}</td>
                                    <td class="text-center">{{ $record->award_days_off }}</td>
                                    {{--                                cột N--}}
                                    <td class="text-center">{{ $record->compensatory_day_off }}</td>
                                    {{--                                cột D--}}
                                    <td class="text-center">{{ $record->pl_to_used_m + $record->plan_pl_to_used_m + $record->pl_in_advance_to_used_m + $record->un_pl_to_used_m + $record->compensatory_day_to_used_m}}</td>
                                    {{--                                cột E--}}
                                    <td class="text-center">{{ $record->pl_to_used_m }}</td>
                                    {{--                                cột F--}}
                                    <td class="text-center">{{ $record->plan_pl_to_used_m }}</td>
                                    {{--                                cột G--}}
                                    <td class="text-center">{{ $record->pl_in_advance_to_used_m }}</td>
                                    {{--                                cột H--}}
                                    <td class="text-center">{{ $record->un_pl_to_used_m }}</td>
                                    {{--                                cột I--}}
                                    <td class="text-center">{{ $record->sl_to_used_m }}</td>
                                    {{--                                cột J--}}
                                    <td class="text-center">{{ $record->compensatory_day_to_used_m }}</td>
                                    {{--                                cột K--}}
                                    <td class="text-center">{{ $record->all_pl_available_m }}</td>
                                    {{--                                cột L--}}
                                    <td class="text-center">{{ $record->all_pl_to_used_m }}</td>
                                    {{--                                cột M--}}
                                    <td class="text-center">{{ $record->all_pl_remain_to_use_m}}</td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="16" class="text-center">No records found</td>
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
