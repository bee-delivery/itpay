<?php

namespace BeeDelivery\ItPay\src;

use BeeDelivery\ItPay\Connection;

class CashIn
{

    public $http;
    protected $cashin;

    public function __construct($token = null)
    {
        $this->http = new Connection($token);
    }

    /**
     * Cria uma nova conta bancária PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/POST-api-v5-ContaBancaria
     * @param Array cashin
     * @return Array
     */
    public function cashin($cashin)
    {
        $cashin = $this->setCashIn($cashin);
        return $this->http->post('api/cashin', ['json' => $cashin]);
    }

    /**
     * Faz merge nas informações da conta.
     *
     * @param Array $cashin
     * @return Array
     */
    public function setCashIn($cashin)
    {
        try {
            if ( ! $this->cashin_is_valid($cashin) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->cashin = array(
                'customer' => '',
                'account' => '',
                'amount' => '',
                'description' => '',
                'external_reference' => ''
            );

            $this->cashin = array_merge($this->cashin, $cashin);
            return $this->cashin;

        } catch (\Exception $e) {
            return 'Erro ao definir a conta. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $cashin
     * @return Boolean
     */
    public function cashin_is_valid($cashin)
    {
        return ! (
            empty($conta['customer']) OR
            empty($conta['account']) OR
            empty($conta['amount']) OR
            empty($conta['description'])
        );
    }
}

