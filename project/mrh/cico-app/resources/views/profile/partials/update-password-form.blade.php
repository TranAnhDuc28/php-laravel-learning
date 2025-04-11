<script src="{{ asset('js/updatepassword.js') }}"></script>
<section class="card-body">
    <header class="mb-4">
        <p class="text-muted small">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" id="updatePasswordForm" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-3">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password"
                          name="current_password"
                          type="password"
                          placeholder="Enter your current password here"
                          autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="mb-3">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password"
                          name="password"
                          type="password"
                          placeholder="Enter your new password here"
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div class="mb-3">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation"
                          name="password_confirmation"
                          type="password"
                          placeholder="Re-enter your new password here"
                          autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="d-flex align-items-center gap-1">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-success mb-0 small"
                >{{ __('Saved.') }}</p>
            @endif
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</section>
