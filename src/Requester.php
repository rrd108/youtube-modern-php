<?php

namespace Rrd108\PhpCliCrypto;

use GuzzleHttp\Client;

class Requester
{

    private $key;
    private $url;

    public function __construct($config)
    {
        $this->key = $config['apiKey'];
        $this->url = $config['apiUrl'];
    }

    public function getRates($crypto, $currency)
    {
        $client = new Client();
        $response = $client->request('GET', $this->url . 'fsym=' . $crypto . '&tsyms=' . $currency, [
            'headers' => [
                'Authorization' => 'Apikey ' . $this->key
            ]
        ]);
        $rates = json_decode($response->getBody(), true);
        return $rates;
    }
}
