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
                request()->routeIs('baseUi.notifications') => ['resources/js/pages/base_ui/notifications.js'],
                request()->routeIs('baseUi.alerts') => ['resources/js/pages/base_ui/alerts.js'],
                request()->routeIs('baseUi.badges') => ['resources/js/pages/base_ui/base-ui.js'],
                request()->routeIs('baseUi.buttons') => ['resources/js/pages/base_ui/base-ui.js'],
                request()->routeIs('baseUi.cards') => ['resources/js/pages/base_ui/cards.js'],
                request()->routeIs('baseUi.carousel') => ['resources/js/pages/base_ui/carousel.js'],
                request()->routeIs('baseUi.dropdowns') => ['resources/js/pages/base_ui/dropdowns.js'],
                request()->routeIs('baseUi.grid') => ['resources/js/pages/base_ui/base-ui.js'],
                default => [],
            });

            view()->share('viteEntries', $viteEntries);
        });
    }
}
