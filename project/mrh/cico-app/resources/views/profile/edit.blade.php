<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

{{--    <div class="py-12">--}}
{{--        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">--}}
{{--            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.update-profile-information-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.update-password-form')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
{{--                <div class="max-w-xl">--}}
{{--                    @include('profile.partials.delete-user-form')--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
        <div class="col-md-12">
            <div class="container min-vh-100 mt-5 mb-5 pb-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card" style="border-color: #0d6efd;">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Update your password</h6>
                            </div>
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @include('layouts.menubar')
</x-app-layout>
