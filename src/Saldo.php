<?php

namespace BeeDelivery\PagueVeloz\src;



use BeeDelivery\PagueVeloz\Connection;

class Saldo
{

    public $http;
    protected $saldo;

    public function __construct($clienteEmail = null, $clienteToken = null)
    {
        $this->http = new Connection($clienteEmail, $clienteToken);
    }

    /**
     * Consulta o saldo de um cliente PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/GET-api-v1-Saldo
     * @param Array saldo
     * @return Array
     */
    public function saldo()
    {
        return $this->http->get('api/v3/Saldo');
    }

}
