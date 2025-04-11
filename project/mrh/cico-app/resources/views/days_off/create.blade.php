<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-color: #0d6efd;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Create Day Off Planned</h6>
                    </div>
                    <div class="card-body">
                        <x-input-error :messages="$errors->all()" class="mt-2" />
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('days-off.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date"
                                       class="form-control @error('start_date') is-invalid @enderror"
                                       id="start_date"
                                       name="start_date"
                                       value="{{ old('start_date') }}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date"
                                       class="form-control @error('end_date') is-invalid @enderror"
                                       id="end_date"
                                       name="end_date"
                                       value="{{ old('end_date') }}"
                                       required>
                            </div>

                            <div class="mb-3">
                                <label for="leave_type" class="form-label">Leave Type</label>
                                <select class="form-select @error('leave_type') is-invalid @enderror"
                                        id="leave_type"
                                        name="leave_type"
                                        required>
                                    <option value="1" {{ old('leave_type') == 1 ? 'selected' : '' }}>Paid Leave</option>
{{--                                    <option value="5" {{ old('leave_type') == 5 ? 'selected' : '' }}>Special Leave</option>--}}
{{--                                    <option value="3" {{ old('leave_type') == 3 ? 'selected' : '' }}>Paid Leave in advance</option>--}}
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDate = document.getElementById('start_date');
            const endDate = document.getElementById('end_date');

            startDate.addEventListener('change', function() {
                endDate.min = this.value;
                if (endDate.value && endDate.value < this.value) {
                    endDate.value = this.value;
                }
            });

            endDate.addEventListener('change', function() {
                startDate.max = this.value;
                if (startDate.value && startDate.value > this.value) {
                    startDate.value = this.value;
                }
            });
        });
    </script>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
