<?php

namespace BeeDelivery\ItPay\src;

use BeeDelivery\ItPay\Connection;

class Pix
{

    public $http;
    protected $pix;

    public function __construct($token = null)
    {
        $this->http = new Connection($token);
    }

    /**
     * Cria uma nova conta bancária PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/POST-api-v5-ContaBancaria
     * @param Array $pix
     * @return Array
     */
    public function pix($pix)
    {
        $pix = $this->setPix($pix);
        return $this->http->post('api/pix', ['json' => $pix]);
    }

    /**
     * Faz merge nas informações da conta.
     *
     * @param Array $pix
     * @return Array
     */
    public function setPix($pix)
    {
        try {
            if ( ! $this->pix_is_valid($pix) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->cashin = array(
                'customer' => '',
                'account' => '',
                'amount' => '',
                'description' => '',
                'key_type' => '',
                'key' => '',
                'external_reference' => ''
            );

            $this->pix = array_merge($this->pix, $pix);
            return $this->pix;

        } catch (\Exception $e) {
            return 'Erro ao definir a conta. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $pix
     * @return Boolean
     */
    public function pix_is_valid($pix)
    {
        return ! (
            empty($conta['customer']) OR
            empty($conta['account']) OR
            empty($conta['amount']) OR
            empty($conta['description']) OR
            empty($conta['key_type']) OR
            empty($conta['key'])
        );
    }
}

