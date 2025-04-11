<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

{{--    <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--        <div>--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="current-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Remember Me -->--}}
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">--}}
{{--                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            @if (Route::has('password.request'))--}}
{{--                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">--}}
{{--                    {{ __('Forgot your password?') }}--}}
{{--                </a>--}}
{{--            @endif--}}

{{--            <x-primary-button class="ms-3">--}}
{{--                {{ __('Log in') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
    <div class="col-md-6 d-flex flex-column justify-content-center">
        <!-- Logo Description -->
{{--        <img src="path/to/facebook-logo.png" alt="Bip System VietNam" class="img-fluid mb-3">--}}
        <!-- Slogan -->
        <div class="container">
            <div class="row justify-content-center text-center">
                <img src="{{ asset('img/logo-full.png') }}" alt="Logo" class="img-fluid mw-100 w-25 mb-3" style="min-width: 50%">
                <h4 class="text-white">BIP SYSTEMS VIETNAM CO., LTD.</h4>
                <p class="text-white">Check-in and Check-out system</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 d-flex align-items-center justify-content-end">
        <!-- Form container -->
        <div class="card shadow bg-transparent" style="width: 100%;">
            <div class="card-body">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
{{--                @error('email')--}}
{{--                <div class="text-red-500 mt-2">{{ $message }}</div>--}}
{{--                @enderror--}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email Address -->
                    <div class="form-group p-1">
                        <label class="text-white" for="email">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email here" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
{{--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>--}}
                    </div>
                    <!-- Password -->
                    <div class="form-group p-1">
                        <label class="text-white" for="password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password here" name="password" required autocomplete="password">
                    </div>
                    <!-- Remember Me -->
                    <div class="form-group p-1">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label text-white" for="remember_me">Remember me</label>
                        </div>
                    </div>

                    <div class="form-group p-1 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
