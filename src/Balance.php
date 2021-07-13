<?php

namespace BeeDelivery\ItPay\src;

use BeeDelivery\ItPay\Connection;

class Balance
{

    public $http;
    protected $balance;

    public function __construct($token = null)
    {
        $this->http = new Connection($token);
    }

    /**
     * Consulta o saldo de um cliente ItPay.
     *
     * @see https://www.itpay.com.br/Help/Api/GET-api-v1-Saldo
     * @param Array balance
     * @return Array
     */
    public function balance()
    {
        return $this->http->get('api/balance');
    }

}
