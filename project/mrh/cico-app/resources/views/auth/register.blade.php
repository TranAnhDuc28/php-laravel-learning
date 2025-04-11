<x-app-layout>
    <div class="container min-vh-100 mt-5 mb-5 pt-5 pb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-color: #0d6efd;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Create New User</h6>
                    </div>
                    <div class="card-body">
{{--                        <x-alert-status/>--}}
{{--                        <x-input-error :messages="$errors->all()" class="mt-2" />--}}
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Role -->
                            <div>
                                <x-input-label for="role" :value="__('Role')" />
                    {{--            <x-dropdown id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required autofocus autocomplete="role" />--}}
                                <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                                    @foreach(config('roles.get_select_options')() as $value => $label)
                                        {{--                                        <option value="{{ $value }}">{{ $label }}</option>--}}
                                        <option value="{{ $value }}"
                                            {{ old('role', isset($user) ? $user->role : '1') == $value ? 'selected' : '' }}>
                                            {{ $label }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>
                            <div class="mt-4">
                                <label for="join_date" class="form-label">Join Date</label>
                                <input type="date"
                                       value="{{ old('join_date') }}" class="form-control @error('join_date') is-invalid @enderror" id="join_date" name="join_date" required>
                                @error('join_date')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Password -->
                            <div class="mt-4">
                                <x-input-label for="password" :value="__('Password')" />

                                <x-text-input id="password" class="block mt-1 w-full"
                                                type="password"
                                                name="password"
                                                required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                type="password"
                                                name="password_confirmation" required autocomplete="new-password" />

                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>
                            <div class="mt-3 mb-3">
                                <button type="submit" id="submitBtn" class="btn btn-primary">Register</button>
                                <a href="{{ route('user.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
{{--                            <div class="flex items-center justify-end mt-4">--}}
{{--                                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">--}}
{{--                                    {{ __('Already registered?') }}--}}
{{--                                </a>--}}

{{--                                <x-primary-button class="ms-4">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </x-primary-button>--}}
{{--                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.menubar')
</x-app-layout>
