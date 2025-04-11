<x-app-layout>
    @php
        $yesterday = now()->subDay()->format('Y-m-d');
    @endphp
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-color: #0d6efd;">
                    <div class="card-header">Create Overtime Form</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('overtime-forms.store') }}">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <select class="form-control @error('date') is-invalid @enderror"
                                        id="date"
                                        name="date"
                                        required
                                    {{ $checkio_records->isEmpty() ? 'disabled' : '' }}>
                                    @if($checkio_records->isEmpty())
                                        <option value="">No dates available</option>
                                    @else
                                        <option value="" disabled selected>Choose a date</option>
                                        @foreach($checkio_records as $record)
                                            <option value="{{ $record->date }}">
                                                {{ $record->date->format('Y-m-d') }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
{{--                                <select class="form-control @error('date') is-invalid @enderror" id="date" name="date" required>--}}
{{--                                    <option value="">Select an option</option>--}}
{{--                                    @foreach($checkio_records as $record)--}}
{{--                                        <option value="{{ $record->date }}">--}}
{{--                                            {{ $record->date->format('Y-m-d') }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
                                @error('date')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <span class="form-label">Paid Leave (h)</span>
                                <span class="form-control" id="paid_leave">
                                    ---
                                </span>
                            </div>

                            <div class="mb-3">
                                <span class="form-label">Actual Official Working Hours</span>
                                <span class="form-control" id="actual_official_working_hours">
                                    ---
                                </span>
                            </div>

                            <div class="mb-3">
                                <span class="form-label">Actual Overtime (h)</span>
                                <span class="form-control" id="actual_over_time">
                                    ---
                                </span>
                            </div>

                            <div class="mb-3">
                                <span class="form-label">Total Actual Working Hours (h)</span>
                                <span class="form-control" id="total_time">
                                    ---
                                </span>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('overtime-forms.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
    <script>
    $(document).ready(function() {
        $('#date').on('change', function() {
            var selectDate = document.getElementById('date');
            var date = selectDate.options[selectDate.selectedIndex].text;
            if (!date) return;
            document.getElementById('paid_leave').textContent = "";
            document.getElementById('actual_official_working_hours').textContent = "";
            document.getElementById('actual_over_time').textContent = "";
            document.getElementById('total_time').textContent = "";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('overtime-forms.info') }}",
                method: 'POST',
                data: {
                    //'_token' : "{{ csrf_token() }}",
                    'date' : date
                },
                success: function (response) {
                    // Hiển thị thông báo thành công
                    if (response.success) {
                        document.getElementById('paid_leave').textContent = response.paid_leave;
                        document.getElementById('actual_official_working_hours').textContent = response.actual_official_working_hours;
                        document.getElementById('actual_over_time').textContent = response.over_time;
                        document.getElementById('total_time').textContent = response.total_time;
                        refreshToken();
                    }
                },
                error: function (xhr) {
                    alert('Error updating data');
                }
            });
        });
    });
    function refreshToken() {
        $.get('/refresh-csrf').done(function(data){
            $('meta[name="csrf-token"]').attr('content', data);
            $('input[name="_token"]').val(data);
        });
    }
    </script>
</x-app-layout>
