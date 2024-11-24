<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        //
//         if (app()->environment('production')) {
//             URL::forceScheme('https');
//         }
            // if (env('APP_ENV') !== 'local') { // HTTPS працюватиме тільки для продакшн середовища
            //     URL::forceScheme('https');
            // }
    }
}
