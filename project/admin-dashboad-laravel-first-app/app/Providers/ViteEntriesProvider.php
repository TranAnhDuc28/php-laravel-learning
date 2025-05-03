<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViteEntriesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function () {
            $viteEntries = ['resources/js/main.js'];

            $viteEntries = array_merge($viteEntries, match (true) {
                request()->routeIs('app.calendar.main') => ['resources/js/pages/calendar.js'],
                request()->routeIs('baseUi.notifications') => ['resources/js/pages/notifications.js'],
                request()->routeIs('baseUi.alerts') => ['resources/js/pages/alerts.js'],
                default => [],
            });

            view()->share('viteEntries', $viteEntries);
        });
    }
}
