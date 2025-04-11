<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Overtime Forms</h5>
                        <a href="{{ route('overtime-forms.create') }}" class="btn btn-primary">Create New Form</a>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>In</th>
                                    <th>Out</th>
                                    <th>Paid Leave</th>
                                    <th>Working Hours</th>
                                    <th>Actual OT</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($forms as $form)
                                    <tr>
                                        <td>{{ $form->date->format('Y-m-d') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($form->start_time)->format('H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($form->end_time)->format('H:i') }}</td>
                                        <td>{{ $form->paid_leave }}</td>
                                        <td>{{ $form->official_working_hours }}</td>
                                        <td>{{ $form->over_time }}</td>
                                        <td>{{ $form->total_time }}</td>
                                        <td>
                                            @if($form->verify_status)
                                                <span class="badge bg-success">Verified</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($form->verify_status)
                                                <button type="button" class="btn btn-sm btn-secondary">Delete</button>
                                            @else
                                                <form action="{{ route('overtime-forms.destroy', $form) }}" method="POST" class="d-inline">
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

{{--                        {{ $forms->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
