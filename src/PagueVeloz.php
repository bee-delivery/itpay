<?php

namespace BeeDelivery\PagueVeloz;

use BeeDelivery\PagueVeloz\src\Cliente;
use BeeDelivery\PagueVeloz\src\Saldo;
use BeeDelivery\PagueVeloz\src\Transferencia;
use BeeDelivery\PagueVeloz\src\Usuario;

class PagueVeloz
{

    public function cliente($userEmail = null, $userToken = null) {
        return new Cliente($userEmail, $userToken);
    }

    public function transferencia() {
        return new Transferencia();
    }

    public function usuario() {
        return new Usuario();
    }

    public function saldo($userEmail = null, $userToken = null) {
        return new Saldo($userEmail, $userToken);
    }
}
