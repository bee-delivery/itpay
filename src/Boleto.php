<?php

namespace BeeDelivery\ItPay\src;

use BeeDelivery\ItPay\Connection;

class Boleto
{
    public $http;
    protected $boleto;

    public function __construct($token = null)
    {
        $this->http = new Connection($token);
    }

    /**
     * Cria um novo boleto.
     *
     * @see https://www.itpay.com.br/Help/Api/POST-api-v7-Boleto
     * @param Array boleto
     * @return Array
     */
    public function create($boleto)
    {
        $boleto = $this->setBoleto($boleto);

        return $this->http->post('api/boletos', ['json' => $boleto]);
    }


    /**
     * Faz merge nas informações do boleto.
     *
     * @param Array $boleto
     * @return Array
     */
    public function setBoleto($boleto)
    {
        try {

            if ( ! $this->boleto_is_valid($boleto) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->boleto = array(
                'customer_id' => '',
                'account_id' => '',
                'description' => '',
                'amount' => 0,
                'due_date' => ''
            );

            $this->boleto = array_merge($this->boleto, $boleto);

            return $this->boleto;

        } catch (\Exception $e) {
            return 'Erro ao definir o boleto. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados do boleto são válidos.
     *
     * @param array $boleto
     * @return Boolean
     */
    public function boleto_is_valid($boleto)
    {
        return ! (
            empty($boleto['customer_id']) OR
            empty($boleto['account_id']) OR
            empty($boleto['description']) OR
            empty($boleto['amount']) OR
            empty($boleto['due_date'])
        );
    }
}
