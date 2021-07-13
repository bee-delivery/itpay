<?php

namespace BeeDelivery\ItPay;

use Illuminate\Support\ServiceProvider;

class PagueVelozServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/pagueveloz.php', 'pagueveloz');

        // Register the service the package provides.
        $this->app->singleton('pagueveloz', function ($app) {
            return new PagueVeloz;
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
            __DIR__.'/config/pagueveloz.php' => config_path('pagueveloz.php'),
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pagueveloz'];
    }
}
