<?php

namespace DavidWesdijk\LaravelPolymorphicEav\Providers;

use Illuminate\Support\ServiceProvider;

class PolymorphicEavServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
         $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

         $this->publishes([
            __DIR__.'/../../config/config.php' => config_path('laravel-polymorphic-eav.php'),
        ]);
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'laravel-polymorphic-eav');
    }
}
