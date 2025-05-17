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
        View::composer('*', static function () {
            $viteEntries = ['resources/js/main.js'];

            $viteEntries = array_merge($viteEntries, match (true) {
                request()->routeIs('employee*') => ['resources/js/pages/human-resources.js'],
                request()->routeIs('project*') => ['resources/js/pages/project-management.js'],
                default => [],
            });

            view()->share('viteEntries', $viteEntries);
        });
    }
}
