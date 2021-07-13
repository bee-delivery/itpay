<?php

namespace BeeDelivery\ItPay\src;

use BeeDelivery\ItPay\Connection;

class CashOut
{

    public $http;
    protected $cashout;

    public function __construct($token = null)
    {
        $this->http = new Connection($token);
    }

    /**
     * Cria uma nova conta bancária PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/POST-api-v5-ContaBancaria
     * @param Array cashout
     * @return Array
     */
    public function cashout($cashout)
    {
        $cashout = $this->setCashOut($cashout);
        return $this->http->post('api/cashout', ['json' => $cashout]);
    }

    /**
     * Faz merge nas informações da conta.
     *
     * @param Array $cashout
     * @return Array
     */
    public function setCashOut($cashout)
    {
        try {
            if ( ! $this->cashout_is_valid($cashout) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->cashout = array(
                'customer' => '',
                'account' => '',
                'amount' => '',
                'description' => '',
                'external_reference' => ''
            );

            $this->cashout = array_merge($this->cashout, $cashout);
            return $this->cashout;

        } catch (\Exception $e) {
            return 'Erro ao definir a conta. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $cashout
     * @return Boolean
     */
    public function cashout_is_valid($cashout)
    {
        return ! (
            empty($conta['customer']) OR
            empty($conta['account']) OR
            empty($conta['amount']) OR
            empty($conta['description'])
        );
    }
}

