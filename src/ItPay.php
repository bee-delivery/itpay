<?php

namespace BeeDelivery\ItPay;

use BeeDelivery\ItPay\src\Customer;
use BeeDelivery\ItPay\src\Transfer;
use BeeDelivery\ItPay\src\Balance;
use BeeDelivery\ItPay\src\Pix;

class ItPay
{

    public function customer($token) {
        return new Customer($token);
    }

    public function transfer($token) {
        return new Transfer($token);
    }

    public function balance($token) {
        return new Balance($token);
    }

    public function pix($token) {
        return new Pix($token);
    }

}
