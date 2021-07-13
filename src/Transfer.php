<?php

namespace BeeDelivery\ItPay\src;

use BeeDelivery\ItPay\Connection;

class Transfer
{

    public $http;
    protected $creditcard;

    public function __construct($token = null)
    {
        $this->http = new Connection($token);
    }

    /**
     * Efetua uma transferência entre contas PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/POST-api-v3-Transferencia
     * @param Array transferencia
     * @return Array
     */
    public function transaction($creditcard)
    {
        $creditcard = $this->setCreditCard($creditcard);

        return $this->http->post('api/creditcard', ['json' => $creditcard]);
    }


    /**
     * Faz merge nas informações da transferência.
     *
     * @param Array $transfer
     * @return Array
     */
    public function setCreditCard($creditcard)
    {
        try {

            if ( ! $this->creditcard_is_valid($creditcard) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->transfer = array(
                'account_id_from' => '',
                'account_id_to' => '',
                'description' => '',
                'amount' => ''
            );

            $this->creditcard = array_merge($this->creditcard, $creditcard);

            return $this->creditcard;

        } catch (\Exception $e) {
            return 'Erro ao definir a transferência. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $creditcard
     * @return Boolean
     */
    public function creditcard_is_valid($creditcard)
    {
        return ! (
            empty($transferencia['customer_id']) OR
            empty($transferencia['account_id']) OR
            empty($transferencia['holder_name']) OR
            empty($transferencia['number']) OR
            empty($transferencia['expiry']) OR
            empty($transferencia['ccv']) OR
            empty($transferencia['amount'])
        );
    }
}
