<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
   function ($app) {
        return new \App\Services\BukuService();
    };
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
