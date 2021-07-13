<?php

namespace BeeDelivery\ItPay\src;



use BeeDelivery\ItPay\Connection;

class CreditCard
{

    public $http;
    protected $conta;

    public function __construct($clienteEmail = null, $clienteToken = null)
    {
        $this->http = new Connection($clienteEmail, $clienteToken);
    }

    /**
     * Listar contas bancárias cadastradas na PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/GET-api-v5-ContaBancaria
     * @return Array
     */
    public function listar()
    {
        return $this->http->get('api/v5/ContaBancaria');
    }

    /**
     * Cria uma nova conta bancária PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/POST-api-v5-ContaBancaria
     * @param Array conta
     * @return Array
     */
    public function criar($conta)
    {
        $conta = $this->setConta($conta);
        return $this->http->post('api/v5/ContaBancaria', ['json' => $conta]);
    }

    /**
     * Pesquisa um cliente PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/GET-api-v5-ContaBancaria-id
     * @param Array id
     * @return Array
     */
    public function encontrar($id)
    {
        return $this->http->get('api/v5/ContaBancaria/' . $id );
    }

    /**
     * Altera uma conta bancária PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/PUT-api-v5-ContaBancaria-id
     * @param Integer id
     * @param Array conta
     * @return Array
     */
    public function alterar($id, $conta)
    {
        $conta = $this->setConta($conta);
        return $this->http->put('api/v5/ContaBancaria/' . $id , ['form_params' => $conta]);
    }

    /**
     * Faz merge nas informações da conta.
     *
     * @param Array $conta
     * @return Array
     */
    public function setConta($conta)
    {
        try {
            if ( ! $this->conta_is_valid($conta) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->cliente = array(
                'CodigoBanco'               => '',
                'Operacao'                  => '',
                'CodigoAgencia'             => '',
                'DigitoAgencia'             => '',
                'NumeroConta'               => '',
                'DigitoConta'               => '',
                'Descricao'                 => '',
                'TipoConta'                 => '',
                'TipoTitular'               => '',
                'Titular'                   =>
                    [
                        'Nome'                  => '',
                        'Documento'             => '',
                        'TipoPessoa'            => 'NaoDefinido'
                    ],
                'DataValidadeSolicitada'    => ''
            );

            $this->conta = array_merge($this->cliente, $conta);
            return $this->conta;

        } catch (\Exception $e) {
            return 'Erro ao definir a conta. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $conta
     * @return Boolean
     */
    public function conta_is_valid($conta)
    {
        return ! (
            empty($conta['CodigoBanco']) OR
            empty($conta['CodigoAgencia']) OR
            empty($conta['NumeroConta']) OR
            empty($conta['DigitoConta']) OR
            empty($conta['Descricao']) OR
            $conta['TipoConta'] == '' OR
            $conta['TipoTitular'] == '' OR
            empty($conta['Titular']['Nome']) OR
            empty($conta['Titular']['Documento'])
        );
    }
}

