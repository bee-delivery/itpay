<?php

namespace BeeDelivery\ItPay\Facades;

use Illuminate\Support\Facades\Facade;

class ItPay extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'itpay';
    }
}
