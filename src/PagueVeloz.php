<?php

namespace BeeDelivery\PagueVeloz;

use BeeDelivery\PagueVeloz\src\Cliente;
use BeeDelivery\PagueVeloz\src\Transferencia;
use BeeDelivery\PagueVeloz\src\Usuario;

class PagueVeloz
{

    public function cliente() {
        return new Cliente();
    }

    public function transferencia() {
        return new Transferencia();
    }

    public function usuario() {
        return new Usuario();
    }
}
