<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
{{--        <div class="row mb-4">--}}
{{--            <div class="col text-white">--}}
{{--                <h6>Check In/Out History</h6>--}}
{{--            </div>--}}
{{--            <div class="col text-end">--}}
{{--                <a href="{{ route('check_in_out.create') }}" class="btn btn-primary">Add New Record</a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        @if(session('success'))--}}
{{--            <div class="alert alert-success alert-dismissible fade show" role="alert">--}}
{{--                {{ session('success') }}--}}
{{--                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
{{--            </div>--}}
{{--        @endif--}}

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Check In/Out History</h6>
{{--                <a href="{{ route('application-forms.create') }}" class="btn btn-primary">Create New Form</a>--}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Day</th>
                            <th>Date</th>
{{--                            <th>User</th>--}}
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>In Lack Time</th>
                            <th>Out Lack Time</th>
                            <th>Over Time</th>
{{--                            <th>Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($checkInOuts as $record)
                            <tr>
{{--                                <td>{{ $record->date }}</td>--}}
{{--                                <td>{{ $record->user->name }}</td>--}}
{{--                                <td>{{ $record->check_in }}</td>--}}
{{--                                <td>{{ $record->check_out }}</td>--}}
                                <td>{{ \Carbon\Carbon::parse($record->date)->format('l') }}</td>
                                <td>{{ \Carbon\Carbon::parse($record->date)->format('Y-m-d') }}</td>
                                <td>{{ $record->check_in ? \Carbon\Carbon::parse($record->check_in)->format('H:i') : '-' }}</td>
                                <td>{{ $record->check_out ? \Carbon\Carbon::parse($record->check_out)->format('H:i') : '-' }}</td>
{{--                                <td>{{ \Carbon\Carbon::parse($record->check_in)->format('H:i') }}</td>--}}
{{--                                <td>{{ \Carbon\Carbon::parse($record->check_out)->format('H:i') }}</td>--}}
                                <td>{{ $record->in_lack_time ?? 0 }} minutes</td>
                                <td>{{ $record->out_lack_time ?? 0 }} minutes</td>
                                <td>{{ $record->over_time ?? 0 }} minutes</td>
{{--                                <td>--}}
{{--                                    <div class="btn-group" role="group">--}}
{{--                                        <a href="{{ route('check_in_out.show', $record) }}"--}}
{{--                                           class="btn btn-sm btn-info">View</a>--}}
{{--                                        <a href="{{ route('check_in_out.edit', $record) }}"--}}
{{--                                           class="btn btn-sm btn-warning">Edit</a>--}}
{{--                                        <form action="{{ route('check_in_out.destroy', $record) }}"--}}
{{--                                              method="POST"--}}
{{--                                              onsubmit="return confirm('Are you sure?')"--}}
{{--                                              class="d-inline">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>--}}
{{--                                        </form>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $checkInOuts->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
