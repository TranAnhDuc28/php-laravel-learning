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
            <form method="GET" action="{{ route('application-forms.list') }}" id="filterForm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Application Form Approval</h6>
                <div class="d-flex gap-2">
                <select name="month" class="form-select select-compact" onchange="this.form.submit()">
                    @foreach($months as $value => $label)
                        <option value="{{ $value }}" {{ $selectedMonth == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @if(auth()->user()->isPu() || auth()->user()->isMod())
                    <select name="user_id" class="form-select select-compact" onchange="this.form.submit()">
                        <option value="all" {{ $selectedUserId == 'all' ? 'selected' : '' }}>All Users</option>
                        @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ $selectedUserId == $member->id ? 'selected' : '' }}>
                                {{ $member->name }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <select name="user_id" class="form-select select-compact" onchange="this.form.submit()">
                        <option value="all" {{ $selectedUserId == 'all' ? 'selected' : '' }}>All Users</option>
                        @foreach($members as $member)
                            <option value="{{ $member->user_id }}" {{ $selectedUserId == $member->user_id ? 'selected' : '' }}>
                                {{ $member->user->name }}
                            </option>
                        @endforeach
                    </select>
                @endif

                </div>
            </div>
            <div class="card-body">
                <x-alert-status/>
                <div class="table-responsive table-fixed-header">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            @if(auth()->user()->isMod())
                                <th></th>
                            @else
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                </th>
                            @endif
                            <th>Name</th>
                            <th>Leave Type</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Total</th>
                            <th>Reason</th>
                            <th>Status</th>
{{--                            <th>Actions</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            @forelse ($applications as $application)
                                <tr>
                                    <td>
                                        @if(!$application->verify_status)
                                            <input type="checkbox" class="form-check-input application-checkbox"
                                                   value="{{ $application->id }}">
                                        @endif
                                    </td>
                                    <td>{{ $application->user->name }}</td>
                                    <td>{{ config('leave_types.get_label')($application->leave_type) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($application->start_date)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($application->end_date)) }}</td>
                                    <td>{{ date('H:i', strtotime($application->start_time)) }}</td>
                                    <td>{{ date('H:i', strtotime($application->end_time)) }}</td>
                                    <td>{{ $application->total_hours }} hours</td>
                                    <td>
                                        <span class="text-truncate d-inline-block" style="max-width: 200px;" title="{{ $application->leave_reason }}">
                                            {{ $application->leave_reason }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($application->verify_status)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No records found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mb-3">
                    @if(auth()->user()->isMod())
                        <button class="btn btn-primary" disabled>
                            You don't have permission to approve
                        </button>
                    @else
                        <button id="approveSelected" class="btn btn-primary" disabled>
                            Approve Selected
                        </button>
                    @endif
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
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
    <script>
        $(document).ready(function() {
            // User filter handling
            {{--$('#userFilter').change(function() {--}}
            {{--    window.location.href = "{{ route('application-forms.list') }}?user_id=" + $(this).val();--}}
            {{--});--}}

            // Select all checkbox handling
            $('#selectAll').change(function() {
                $('.application-checkbox').prop('checked', $(this).prop('checked'));
                updateApproveButton();
            });

            // Individual checkbox handling
            $('.application-checkbox').change(function() {
                updateApproveButton();
                // Update select all checkbox
                if ($('.application-checkbox:checked').length === $('.application-checkbox').length) {
                    $('#selectAll').prop('checked', true);
                } else {
                    $('#selectAll').prop('checked', false);
                }
            });

            // Update approve button state
            function updateApproveButton() {
                if ($('.application-checkbox:checked').length > 0) {
                    $('#approveSelected').prop('disabled', false);
                } else {
                    $('#approveSelected').prop('disabled', true);
                }
            }

            // Approve selected applications
            $('#approveSelected').click(function() {
                let selectedIds = $('.application-checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length === 0) return;

                $.ajax({
                    url: "{{ route('application-forms.approval') }}",
                    type: 'POST',
                    data: {
                        application_ids: selectedIds,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        // Reload page after successful approval
                        window.location.reload();
                    },
                    error: function(xhr) {
                        alert('Error approving applications');
                    }
                });
            });
        });
    </script>
</x-app-layout>
