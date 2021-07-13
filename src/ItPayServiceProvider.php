<?php

namespace BeeDelivery\ItPay;

use Illuminate\Support\ServiceProvider;

class ItPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/itpay.php', 'itpay');

        // Register the service the package provides.
        $this->app->singleton('itpay', function ($app) {
            return new ItPay;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/itpay.php' => config_path('itpay.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['itpay'];
    }
}
