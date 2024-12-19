<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('can', function ($expression) {
            return "<?php if (can({$expression})): ?>";
        });

        Blade::directive('endcan', function ($expression) {
            return "<?php endif; ?>";
        });
    }
}
