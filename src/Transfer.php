<?php

namespace BeeDelivery\ItPay\src;



use BeeDelivery\ItPay\Connection;

class Transferencia
{

    public $http;
    protected $transferencia;

    public function __construct($clienteEmail = null, $clienteToken = null)
    {
        $this->http = new Connection($clienteEmail, $clienteToken);
    }

    /**
     * Efetua uma transferência entre contas PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/POST-api-v3-Transferencia
     * @param Array transferencia
     * @return Array
     */
    public function criar($transferencia)
    {
        $transferencia = $this->setTransferencia($transferencia);

        return $this->http->post('api/v3/Transferencia', ['json' => $transferencia]);
    }

    /**
     * Pesquisa uma transferência na PagueVeloz.
     *
     * @see https://www.itpay.com.br/Help/Api/GET-api-v3-Transferencia_seuNumero
     * @param string $seuNumero
     * @return Array
     */
    public function buscarSeuNumero($seuNumero)
    {
        return $this->http->get('api/v3/Transferencia?seuNumero='.$seuNumero);
    }

    /**
     * Faz merge nas informações da transferência.
     *
     * @param Array $transferencia
     * @return Array
     */
    public function setTransferencia($transferencia)
    {
        try {

            if ( ! $this->transferencia_is_valid($transferencia) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->transferencia = array(
                'ClienteDestinoId'  => '',
                'Valor'             => '',
                'Descricao'         => '',
                'SeuNumero'         => ''
            );

            $this->transferencia = array_merge($this->transferencia, $transferencia);

            return $this->transferencia;

        } catch (\Exception $e) {
            return 'Erro ao definir a transferência. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $cliente
     * @return Boolean
     */
    public function transferencia_is_valid($transferencia)
    {
        return ! (
            empty($transferencia['ClienteDestinoId']) OR
            empty($transferencia['Valor']) OR
            empty($transferencia['Descricao'])
        );
    }
}
