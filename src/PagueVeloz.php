<?php

namespace BeeDelivery\PagueVeloz;

use BeeDelivery\PagueVeloz\src\Cliente;
use BeeDelivery\PagueVeloz\src\ContaBancaria;
use BeeDelivery\PagueVeloz\src\Saldo;
use BeeDelivery\PagueVeloz\src\Transferencia;
use BeeDelivery\PagueVeloz\src\Usuario;

class PagueVeloz
{

    public function cliente($clienteEmail, $clienteToken) {
        return new Cliente($clienteEmail, $clienteToken);
    }

    public function transferencia($clienteEmail, $clienteToken) {
        return new Transferencia($clienteEmail, $clienteToken);
    }

    public function usuario($clienteEmail, $clienteToken) {
        return new Usuario($clienteEmail, $clienteToken);
    }

    public function saldo($clienteEmail, $clienteToken) {
        return new Saldo($clienteEmail, $clienteToken);
    }

    public function contaBancaria($clienteEmail, $clienteToken) {
        return new ContaBancaria($clienteEmail, $clienteToken);
    }
}
