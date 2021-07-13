<?php

namespace BeeDelivery\ItPay\src;

use BeeDelivery\ItPay\Connection;

class Customer
{

    public $http;
    protected $customer;

    public function __construct($token = null)
    {
        $this->http = new Connection($token);
    }

    /**
     * Efetua assinatura de um novo customer PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/POST-api-v5-Assinar
     * @param Array customer
     * @return Array
     */
    public function create($customer)
    {
        $customer = $this->setCustomer($customer);
        return $this->http->post('api/customers', ['json' => $customer]);
    }

    /**
     * Atualiza o customer PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/PUT-api-v4-Cliente
     * @param Array customer
     * @return Array
     */
    public function update($customer)
    {
        return $this->http->put('api/customers', ['json' => $customer]);
    }



    /**
     * Faz merge nas informações do cliente.
     *
     * @param Array $customer
     * @return Array
     */
    public function setCustomer($customer)
    {
        try {

            if ( ! $this->customer_is_valid($customer) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->customer = array(
                'name' => '',
                'email' => '',
                'customer_type' => '',
                'document' => '',
                'phone_number' => '',
                'address' => '',
                'address_number' => '',
                'state' => '',
                'city' => ''
            );

            $this->customer = array_merge($this->customer, $customer);
            return $this->customer;

        } catch (\Exception $e) {
            return 'Erro ao definir o cliente. - ' . $e->getMessage();
        }
    }


    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $customer
     * @return Boolean
     */
    public function customer_is_valid($customer)
    {
        return ! (
            empty($customer['name']) OR
            empty($customer['email']) OR
            empty($customer['customer_type']) OR
            empty($customer['document']) OR
            empty($customer['phone_number']) OR
            empty($customer['address']) OR
            empty($customer['address_number']) OR
            empty($customer['state']) OR
            empty($customer['city'])
        );
    }
}

