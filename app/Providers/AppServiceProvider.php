<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        // if (config('app.env') !== 'local') {
        //     URL::forceScheme('https');
        // }
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
