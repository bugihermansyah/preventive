<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use FilamentVersions\Facades\FilamentVersions;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentVersions::addItem('Preventive Support', 'v1.0.0');
    }
}
