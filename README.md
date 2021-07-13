# ItPay Laravel

Pacote de integração com itpay.com.br

## Início

Para começar, é necessário que você crie sua conta em https://www.itpay.com.br/

## Instalando

Instale com [composer](https://getcomposer.org/):

```bash
composer require bee-delivery/itpay
```

## Como utilizar?


[Documentação API ItPay](https://www.itpay.com.br/Help)

### Novo Cliente

Criando uma conta no ItPay. Veja em 

```
$cliente = [
    'Nome'                  => 'JOHN DOE',
    'Documento'             => '00000000000',
    'TipoPessoa'            => 1,
    'Email'                 => 'exemplo@exemplo.com.br',
    'Endereco'              => [
        'CEP'               => '00000000',
        'Bairro'            => 'BAIRRO',
        'Logradouro'        => 'LOGRADOURO',
        'Numero'            => '123',
        'Complemento'       => ''
    ],
    'Telefones'             => [
        [
            'Numero'        => '00900000000',
            'Tipo'          =>  4
        ]
    ],
    'Usuario'               => [
        'Nome'              => 'JOHN DOE',
        'Email'             => 'exemplo@exemplo.com.br',
        'Senha'             => 'Senha123456789',
        'ConfirmacaoSenha'  => 'Senha123456789,
    ],
    'DataNascimento'        => '01/01/1990',
    'UrlNotificacao'        => '',
    'InscricaoEstadual'     => '',
    'InscricaoMunicipal'    => '',
    'Cupom'                 => 'cupom_fornecido_pague_veloz'
];

$response = PagueVeloz::cliente($email, $token)->criar($cliente);
```


## Licença

Sinta-se a vontade em nos ajudar. Faça um PR :)

GNU General Public License v3
