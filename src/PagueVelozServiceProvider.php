<?php

namespace BeeDelivery\PagueVeloz;

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
        //
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
}
