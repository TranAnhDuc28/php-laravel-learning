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
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Day Off Planned List</h6>

                <div class="d-flex gap-2">
                    <a href="{{ route('days-off.create') }}" class="btn btn-primary">Add New</a>
                    <form method="GET" action="{{ route('days-off.list') }}" id="filterForm">
                    <select name="year" id="year" class="form-select" onchange="this.form.submit()">
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <x-alert-status/>
                <div class="table-responsive table-fixed-header">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Leave Type</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($daysOff as $dayOff)
                            <tr>
                                <td>{{ $dayOff->id }}</td>
                                <td>{{ $dayOff->start_date->format('d/m/Y') }}</td>
                                <td>{{ $dayOff->end_date->format('d/m/Y') }}</td>
                                <td>{{ $leaveTypes[$dayOff->leave_type] }}</td>
                                <td>
                                    @php
                                        $duration = $dayOff->start_date->diffInDays($dayOff->end_date) + 1;
                                    @endphp
                                    {{ $duration }} day(s)
                                </td>
                                <td>
                                    <form action="{{ route('days-off.destroy', $dayOff->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this record?');"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No records found</td>
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
