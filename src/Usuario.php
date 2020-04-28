<?php

namespace BeeDelivery\PagueVeloz\src;



use BeeDelivery\PagueVeloz\Connection;

class Usuario
{

    public $http;
    protected $usuario;

    public function __construct($clienteEmail = null, $clienteToken = null)
    {
        $this->http = new Connection($clienteEmail, $clienteToken);
    }

    /**
     * Lista todos os usuários do cliente na PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/GET-api-v2-UsuarioCliente-id
     * @param Array id do cliente
     * @return Array
     */
    public function all($id)
    {
        return $this->http->get('api/v2/UsuarioCliente/'. $id);
    }

    /**
     * Atualiza um usuario PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/PUT-api-v2-UsuarioCliente-id
     * @param Array usuario
     * @return Array
     */
    public function atualizar($id, $usuario)
    {
        return $this->http->put('api/v2/UsuarioCliente/' . $id, ['json' => $usuario]);
    }

    /**
     * Altera a senha de um usuario PagueVeloz.
     *
     * @see https://www.pagueveloz.com.br/Help/Api/PUT-api-v2-UsuarioCliente-AlteraSenha-id
     * @param Array usuario
     * @return Array
     */
    public function changePassword($id, $senha)
    {
        $senha = $this->setSenha($senha);
        //wtf
        return $this->http->put('api/v2/UsuarioCliente/AlteraSenha/' . $id, ['json' => $senha]);
    }


    /**
     * Faz merge nas informações.
     *
     * @param Array $senha
     * @return Array
     */
    public function setSenha($senha)
    {
        try {

            if ( ! $this->senha_is_valid($senha) ) {
                throw new \Exception('Dados inválidos.');
            }

            $this->senha = array(
                'SenhaAtual'        => '',
                'Senha'             => '',
                'ConfirmacaoSenha'  => '',
                'Id'                => ''
            );

            $this->senha = array_merge($this->senha, $senha);
            return $this->senha;

        } catch (\Exception $e) {
            return 'Erro ao definir a senha. - ' . $e->getMessage();
        }
    }

    /**
     * Verifica se os dados da senha são válidas.
     *
     * @param array $usuario
     * @return Boolean
     */
    public function senha_is_valid($senha)
    {
        return ! (
            empty($senha['Senha']) OR
            empty($senha['ConfirmacaoSenha']) OR
            empty($senha['Id']) OR
            ($senha['Senha'] != $senha['ConfirmacaoSenha'])
        );
    }
}

