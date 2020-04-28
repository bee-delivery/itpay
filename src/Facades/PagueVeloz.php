<?php

namespace BeeDelivery\PagueVeloz\Facades;

use Illuminate\Support\Facades\Facade;

class PagueVeloz extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pagueveloz';
    }
}
