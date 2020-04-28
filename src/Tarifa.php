<?php

namespace BeeDelivery\PagueVeloz\src;



use BeeDelivery\PagueVeloz\Connection;

class Tarifa
{

    public $http;
    protected $cliente;

    public function __construct($clienteEmail = null, $clienteToken = null)
    {
        $this->http = new Connection($clienteEmail, $clienteToken);
    }

    /**
     * Ativa um cupom e retorna todas as tarifas do cliente atualizadas.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/POST-api-v1-Tarifa-AtivarCupom
     * @param String cupom
     * @return Array
     */
    public function ativarCupom($cupom)
    {
        return $this->http->post('api/v1/Tarifa/AtivarCupom', ['json' => $cupom]);
    }
}

