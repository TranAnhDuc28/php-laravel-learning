<x-app-layout>
    <script src="{{ asset('js/applicationform.js') }}"></script>
    @php
        $yesterday = now()->subDay()->format('Y-m-d');
    @endphp
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-color: #0d6efd;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Edit Application Form</h6>
                    </div>
                    <div class="card-body">
                        <x-input-error :messages="$errors->all()" class="mt-2" />
                        <form id="leaveForm" method="POST" action="{{ route('application-forms.update', $applicationForm) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="leave_type" class="form-label">Leave Type</label>
                                <select class="form-control @error('leave_type') is-invalid @enderror" id="leave_type" name="leave_type" required>
{{--                                    <option value="">Select Leave Type</option>--}}
{{--                                    <option value="1" {{ $applicationForm->leave_type == 1 ? 'selected' : '' }}>Annual Leave</option>--}}
{{--                                    <option value="2" {{ $applicationForm->leave_type == 2 ? 'selected' : '' }}>Sick Leave</option>--}}
{{--                                    <option value="3" {{ $applicationForm->leave_type == 3 ? 'selected' : '' }}>Personal Leave</option>--}}
                                    @foreach(config('leave_types.get_select_options')() as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('leave_type', isset($applicationForm) ? $applicationForm->leave_type : '1') == $value ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                @error('leave_type')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

{{--                            <div class="mb-3">--}}
{{--                                <label for="start_date" class="form-label">Start Date</label>--}}
{{--                                <input type="date" min="{{ $yesterday }}"--}}
{{--                                       value="{{ old('start_date', isset($applicationForm) ? \Carbon\Carbon::parse($applicationForm->start_date)->format('Y-m-d') : $yesterday) }}" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" required>--}}
{{--                                @error('start_date')--}}
{{--                                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                            <div class="mb-3">
                                <p for="start_date" class="form-label">Start Date</p>
                                <span style=" padding-left: 0.7rem; ">{{ \Carbon\Carbon::parse($applicationForm->start_date)->format('m/d/Y') }}</span>
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" min="{{ \Carbon\Carbon::parse($applicationForm->start_date)->format('Y-m-d') }}"
{{--                                       pattern="\d{4}/\d{2}/\d{2}" onchange="formatDate(this)"--}}
                                       value="{{ old('end_date', isset($applicationForm) ? \Carbon\Carbon::parse($applicationForm->end_date)->format('Y-m-d') : $yesterday) }}" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" required>
                                @error('end_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

{{--                            <div class="mb-3">--}}
{{--                                <label for="start_time" class="form-label">Start Time</label>--}}
{{--                                <input type="time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ $applicationForm->start_time->format('H:i') }}" required>--}}
{{--                                @error('start_time')--}}
{{--                                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

{{--                            <div class="mb-3">--}}
{{--                                <label for="end_time" class="form-label">End Time</label>--}}
{{--                                <input type="time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ $applicationForm->end_time->format('H:i') }}" required>--}}
{{--                                @error('end_time')--}}
{{--                                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}

                            <div class="mb-3">
                                <span id="start_time_label" class="form-label">Start Time</span>
                                <div class="d-flex">
                                    <select class="form-control me-2 @error('start_time_hour') is-invalid @enderror"
                                            id="start_time_hour"
                                            name="start_time_hour"
                                            required>
                                        @for ($hour = 8; $hour <= 17; $hour++)
                                            <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}"
                                                {{ old('start_time_hour', isset($applicationForm) ? $applicationForm->start_time->format('H') : '08') == $hour ? 'selected' : '' }}>
                                                {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <select class="form-control @error('start_time_minute') is-invalid @enderror"
                                            id="start_time_minute"
                                            name="start_time_minute"
                                            required>
                                        @foreach(['00'] as $minute)
{{--                                        @foreach(['00', '15', '30', '45'] as $minute)--}}
                                            <option value="{{ $minute }}"
                                                {{ old('start_time_minute', isset($applicationForm) ? $applicationForm->start_time->format('i') : '00') == $minute ? 'selected' : '' }}>
                                                {{ $minute }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('start_time_hour')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @error('start_time_minute')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <span id="end_time_label" class="form-label">End Time</span>
                                <div class="d-flex">
                                    <select class="form-control me-2 @error('end_time_hour') is-invalid @enderror"
                                            id="end_time_hour"
                                            name="end_time_hour"
                                            required>
                                        @for ($hour = 8; $hour <= 17; $hour++)
                                            <option value="{{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}"
                                                {{ old('end_time_hour', isset($applicationForm) ? $applicationForm->end_time->format('H') : '17') == $hour ? 'selected' : '' }}>
                                                {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}
                                            </option>
                                        @endfor
                                    </select>
                                    <select class="form-control @error('end_time_minute') is-invalid @enderror"
                                            id="end_time_minute"
                                            name="end_time_minute"
                                            required>
                                        @foreach(['00'] as $minute)
{{--                                        @foreach(['00', '15', '30', '45'] as $minute)--}}
                                            <option value="{{ $minute }}"
                                                {{ old('end_time_minute', isset($applicationForm) ? $applicationForm->end_time->format('i') : '00') == $minute ? 'selected' : '' }}>
                                                {{ $minute }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('end_time_hour')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                                @error('end_time_minute')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="leave_reason" class="form-label">Leave Reason</label>
                                <textarea class="form-control @error('leave_reason') is-invalid @enderror" id="leave_reason" name="leave_reason" rows="3" required>{{ old('leave_reason', $applicationForm->leave_reason) }}</textarea>
                                @error('leave_reason')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Update</button>
                                <a href="{{ route('application-forms.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu Bar -->
    @include('layouts.menubar')
</x-app-layout>
