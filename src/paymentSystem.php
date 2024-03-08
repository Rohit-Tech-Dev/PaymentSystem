<?php

namespace YourVendor\YourPackage;

use Illuminate\Support\ServiceProvider;

class YourPackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration files
        // $this->publishes([
        //     __DIR__.'/../config/yourpackage.php' => config_path('yourpackage.php'),
        // ], 'config');

        // Publish views
        $this->publishes([
            __DIR__.'/../resources/views/payments/payG' => resource_path('views/vendor/paymentSystem'),
        ], 'views');

        // Publish assets
        $this->publishes([
            __DIR__.'/../public/payGN' => resource_path('views/vendor/paymentSystem'),
        ], 'public');

        // Load routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // Load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Load translations
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'yourpackage');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register the service here
        // For example, you can register a singleton
        $this->app->singleton('PaymentSysyem', function ($app) {
            return new PaymentSysyem;
        });
    }
}
