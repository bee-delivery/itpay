<?php

namespace BeeDelivery\PagueVeloz\src;



use BeeDelivery\PagueVeloz\Connection;

class Cliente
{

    public $http;
    protected $cliente;

    public function __construct($clienteEmail = null, $clienteToken = null)
    {
        $this->http = new Connection($clienteEmail, $clienteToken);
    }

    /**
     * Efetua assinatura de um novo cliente PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/POST-api-v5-Assinar
     * @param Array cliente
     * @return Array
     */
    public function criar($cliente)
    {
        $cliente = $this->setCliente($cliente);
        return $this->http->post('api/v5/Assinar', ['form_params' => $cliente]);
    }

    /**
     * Pesquisa um cliente PagueVeloz.
     *
     * @see
     * @param Array cliente
     * @return Array
     */
    public function pesquisar($termo)
    {
        return $this->http->get('api/v3/Transferencia/ClienteDestino?filtro=' . $termo );
    }

    /**
     * Lista os documentos pendentes do cliente PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/GET-api-v4-Cliente-DocumentosPendentes_contaBancariaId
     * @return Array
     */
    public function documentosPendentes()
    {
        return $this->http->get('api/v4/Cliente/DocumentosPendentes');
    }

    /**
     * Envia o documento do cliente PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/PUT-api-v4-Cliente-DocumentosPendentes
     * @return Array
     */
    public function documentoEnviar($documento)
    {
        $documento = $this->setDocumento($documento);
        return $this->http->post('api/v4/Cliente/DocumentosPendentes', ['form_params' => $documento]);
    }

    /**
     * Faz merge nas informações do cliente.
     *
     * @param Array $cliente
     * @return Array
     */
    public function setCliente($cliente)
    {
        try {

            if ( ! $this->cliente_is_valid($cliente) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->cliente = array(
                'Nome'                  => '',
                'Documento'             => '',
                'TipoPessoa'            => '',
                'Email'                 => '',
                'Endereco'              => '',
                'Telefones'             => '',
                'Usuario'               => '',
                'DataNascimento'        => '',
                'UrlNotificacao'        => '',
                'InscricaoEstadual'     => '',
                'InscricaoMunicipal'    => '',
                'Cupom'                 => ''
            );

            $this->cliente = array_merge($this->cliente, $cliente);
            return $this->cliente;

        } catch (\Exception $e) {
            return 'Erro ao definir o cliente. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da transferência são válidas.
     *
     * @param array $cliente
     * @return Boolean
     */
    public function cliente_is_valid($cliente)
    {
        return ! (
            empty($cliente['Nome']) OR
            empty($cliente['Documento']) OR
            empty($cliente['TipoPessoa']) OR
            empty($cliente['Email']) OR
            empty($cliente['Endereco']) OR
            empty($cliente['Telefones']) OR
            empty($cliente['Usuario'])
        );
    }


    /**
     * Faz merge nas informações do documento.
     *
     * @param Array $documento
     * @return Array
     */
    public function setDocumento($documento)
    {
        try {

            if ( ! $this->documento_is_valid($documento) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->cliente = array(
                'Id'                        => '',
                'NomeArquivo'               => '',
                'ConteudoArquivoBase64'     => ''
            );

            $this->cliente = array_merge($this->documento, $documento);
            return $this->cliente;

        } catch (\Exception $e) {
            return 'Erro ao definir o documento. - ' . $e->getMessage();
        }
    }


    /**
     * Verifica se os dados do documento são válidas.
     *
     * @param array $documento
     * @return Boolean
     */
    public function documento_is_valid($documento)
    {
        return ! (
            empty($cliente['Id']) OR
            empty($cliente['NomeArquivo']) OR
            empty($cliente['ConteudoArquivoBase64'])
        );
    }
}

