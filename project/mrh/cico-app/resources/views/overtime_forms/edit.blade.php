<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Overtime Form</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('overtime-forms.update', $overtimeForm) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ $overtimeForm->date->format('Y-m-d') }}" required>
                                @error('date')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="start_time" class="form-label">Start Time</label>
                                <input type="time" disabled=true class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ $overtimeForm->start_time }}" required>
                                @error('start_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="end_time" class="form-label">End Time</label>
                                <input type="time" disabled=true class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ $overtimeForm->end_time }}" required>
                                @error('end_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="total_time" class="form-label">Total Time</label>
                                <input type="text" disabled=true class="form-control @error('total_time') is-invalid @enderror" id="total_time" name="total_time" value="{{ $overtimeForm->total_time }}">
                                @error('end_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Update</button>
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
</x-app-layout>
