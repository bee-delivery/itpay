<?php

namespace BeeDelivery\PagueVeloz\src;



use BeeDelivery\PagueVeloz\Connection;

class Boleto
{

    public $http;
    protected $boleto;

    public function __construct($clienteEmail = null, $clienteToken = null)
    {
        $this->http = new Connection($clienteEmail, $clienteToken);
    }

    /**
     * Cria um novo boleto.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/POST-api-v7-Boleto
     * @param Array boleto
     * @return Array
     */
    public function criar($boleto)
    {
        $boleto = $this->setBoleto($boleto);

        return $this->http->post('api/v7/Boleto', ['json' => $boleto]);
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
                'Sacado'            => '',
                'CPFCNPJSacado'     => '',
                'Vencimento'        => '',
                'Valor'             => 0,
                'SeuNumero'         => '',
                'Parcela'           => '',
                'Observacoes'       => '',
                'Email'             => '',
                'DataEnvioEmail'    => '',
                'Pdf'               => true,
                'Desconto'          => [
                    'Tipo'          => '',
                    'Valor'         => 0,
                    'DataLimite'    => ''
                ],
                'Split'             => [
                    [
                        'CpfCnpjCliente'        => '',
                        'ValorFixo'             => 0,
                        'ValorPercentual'       => 0,
                        'ValorTarifaFixo'       => 0,
                        'ValorTarifaPercentual' => 0
                    ],
                    [
                        'CpfCnpjCliente'        => '',
                        'ValorFixo'             => 0,
                        'ValorPercentual'       => 0,
                        'ValorTarifaFixo'       => 0,
                        'ValorTarifaPercentual' => 0
                    ]
                ]
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
     * @param array $cliente
     * @return Boolean
     */
    public function boleto_is_valid($boleto)
    {
        return ! (
            empty($boleto['Sacado']) OR
            empty($boleto['CPFCNPJSacado']) OR
            empty($boleto['Vencimento']) OR
            empty($boleto['Valor'])
        );
    }
}
