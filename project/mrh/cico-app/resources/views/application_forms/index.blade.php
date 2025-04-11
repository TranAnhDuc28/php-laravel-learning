<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Application Forms</h6>
                        <a href="{{ route('application-forms.create') }}" class="btn btn-primary">Create New Form</a>
                    </div>

                    <div class="card-body">
{{--                        @if(session('success'))--}}
{{--                            <div class="alert alert-success">--}}
{{--                                {{ session('success') }}--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        <x-alert-status/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Total</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($forms as $form)
                                    <tr>
                                        <td>{{ config('leave_types.get_label')($form->leave_type) }}</td>
                                        <td>{{ $form->start_date->format('Y-m-d') }}</td>
                                        <td>{{ $form->end_date->format('Y-m-d') }}</td>
                                        <td>{{ $form->start_time->format('H:i A') }}</td>
                                        <td>{{ $form->end_time->format('H:i A') }}</td>
                                        <td>{{ $form->total_hours }} hour(s)</td>
                                        <td>{{ $form->leave_reason }}</td>
                                        <td>
                                            @if($form->verify_status)
                                                <span class="badge bg-success">Verified</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($form->verify_status)
{{--                                                <button type="button" class="btn btn-sm btn-secondary">Edit</button>--}}
                                                <button type="button" class="btn btn-sm btn-secondary">Delete</button>
                                            @else
{{--                                                <a href="{{ route('application-forms.edit', $form) }}" class="btn btn-sm btn-info">Edit</a>--}}
                                                <form action="{{ route('application-forms.destroy', $form) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No records found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $forms->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
