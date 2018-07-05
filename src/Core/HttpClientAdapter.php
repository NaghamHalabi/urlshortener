<?php

namespace hassanalisalem\urlshortener\Core;

use GuzzleHttp\Client;
use hassanalisalem\urlshortener\Contracts\HttpClientInterface;

class HttpClientAdapter implements HttpClientInterface
{
    function __construct($client = null)
    {
        $this->client = $client?: new Client;
    }

    public function buildUrl($url, $parameters = [])
    {
        return $url.'?'.join('&', array_map(function ($key, $value) {
            return "$key=$value";
        }, array_keys($parameters), $parameters));
    }

    public function request($url, $parameters, $verb)
    {
        $url = $this->buildUrl($url, $parameters);
    }
}
