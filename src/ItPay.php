<?php

namespace BeeDelivery\ItPay;

use BeeDelivery\ItPay\src\Customer;
use BeeDelivery\ItPay\src\Transfer;
use BeeDelivery\ItPay\src\Balance;
use BeeDelivery\ItPay\src\Pix;
use BeeDelivery\ItPay\src\CashIn;
use BeeDelivery\ItPay\src\CashOut;

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

    public function cashout($token) {
        return new CashOut($token);
    }

    public function cashin($token) {
        return new CashIn($token);
    }

    public function creditcard($token) {
        return new CreditCard($token);
    }

}
