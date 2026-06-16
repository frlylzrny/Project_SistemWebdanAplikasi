<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GoogleBooksServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(
            \App\Services\GoogleBooksService::class,
            function ($app) {
                return new \App\Services\GoogleBooksService();
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}