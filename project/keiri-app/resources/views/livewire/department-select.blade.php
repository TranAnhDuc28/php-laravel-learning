<div class="col-sm-12 col-md-6 mb-3">
    <label for="id-department" class="form-label">{{ __('Working department') }} (*)</label>
    <select id="id-department" wire:model="department_id" class="form-select @error('department_id') is-invalid @enderror">
        @foreach($departments as $department)
            <option value="{{ $department->id }}" @selected(old('tenant', $selectedTenant->id) == $tenant->id)>{{ $department->name }}</option>
        @endforeach
    </select>
    @error('department_id')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
