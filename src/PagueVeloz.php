<?php

namespace BeeDelivery\PagueVeloz;

use BeeDelivery\PagueVeloz\src\Cliente;
use BeeDelivery\PagueVeloz\src\Saldo;
use BeeDelivery\PagueVeloz\src\Transferencia;
use BeeDelivery\PagueVeloz\src\Usuario;

class PagueVeloz
{

    public function cliente($clienteEmail = null, $clienteToken = null) {
        return new Cliente($clienteEmail, $clienteToken);
    }

    public function transferencia() {
        return new Transferencia();
    }

    public function usuario() {
        return new Usuario();
    }

    public function saldo($clienteEmail = null, $clienteToken = null) {
        return new Saldo($clienteEmail, $clienteToken);
    }
}
