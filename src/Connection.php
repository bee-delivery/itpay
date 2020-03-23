<?php

namespace BeeDelivery\PagueVeloz;

use GuzzleHttp\Client;

class Connection {

    protected $http;
    protected $base_url;
    protected $email;
    protected $token;

    public function __construct($clienteEmail = null, $clienteToken = null) {


        $this->base_url     = config('pagueveloz.base_url');
        $this->email        = $clienteEmail == null ? config('pagueveloz.email') : $clienteEmail;
        $this->token        = $clienteToken == null ? config('pagueveloz.token') : $clienteToken;

        $headers = [
            'Content-Type'  => 'application/json',
            'Authorization' => 'Basic ' . base64_encode($this->email.':'.$this->token)
        ];

        $this->http = new Client([
            'headers' => $headers
        ]);

        return $this->http;
    }

    public function get($url)
    {

        try {
            $response = $this->http->get($this->base_url . $url);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }

    public function post($url, $params)
    {
        try {
            $response = $this->http->post($this->base_url . $url, $params);

            return [
                'code'     => $response->getStatusCode(),
                'response' => json_decode($response->getBody()->getContents())
            ];

        } catch (\Exception $e){
            return [
                'code'     => $e->getCode(),
                'response' => $e->getResponse()->getBody()->getContents()
            ];
        }
    }
}
