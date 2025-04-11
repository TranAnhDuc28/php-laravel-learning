<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="col-md-12 d-flex flex-column justify-content-center">
        <!-- Logo Description -->
        {{--        <img src="path/to/facebook-logo.png" alt="Bip System VietNam" class="img-fluid mb-3">--}}
        <!-- Slogan -->
        <div class="container" style=" margin-top: -250px; ">
            <div class="row justify-content-center text-center">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid mw-100 mb-3" style="min-width: 5%; width: 10%">
                <h4 class="text-white">BIP SYSTEMS VIETNAM CO., LTD.</h4>
                <p class="text-white">Check-in and Check-out system</p>
                <div class="d-flex align-items-center justify-content-center gap-2">
                    @if (Route::has('login'))
                        @auth
                            <h6 class="text-white mt-2">Please click the sky blue button to</h6>
                            <a href="{{ url('/dashboard') }}" class="btn btn-info">
                                Dashboard
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" class="btn" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        @else
                            <h6 class="text-white mt-1">Please click the yellow button to</h6>
                            <a href="{{ route('login') }}" class="btn btn-warning">
                                Log in
                            </a>
{{--                            @if (Route::has('register'))--}}
{{--                                <a href="{{ route('register') }}" class="btn btn-warning">--}}
{{--                                    Register--}}
{{--                                </a>--}}
{{--                            @endif--}}
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
