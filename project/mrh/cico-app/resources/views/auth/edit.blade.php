<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0">Edit User</h6>
                    </div>

                    <div class="card-body">
                        <x-alert-status/>
                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="join_date" class="form-label">Join Date</label>
                                <input type="date" class="form-control" id="join_date" name="join_date" value="{{ old('join_date', $user->join_date) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" id="role" class="form-select @error('role') is-invalid @enderror">
                                    @foreach(config('roles.get_select_options')() as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('role', isset($user) ? $user->role : '1') == $value ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password (Optional)</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            </div>

                            <div class="mt-3 mb-3">
                                <button type="submit" class="btn btn-primary">Update User</button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.menubar')
</x-app-layout>
