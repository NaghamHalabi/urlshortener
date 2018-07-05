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

    /**
     * Build url with parameters
     *
     * @param String $url
     * @param Array $parameters
     * @return String
     */
    public function buildUrl($url, $parameters = [])
    {
        return $url.'?'.join('&', array_map(function ($key, $value) {
            return "$key=$value";
        }, array_keys($parameters), $parameters));
    }

    /**
     * Sends the request to the url
     *
     * @param String $url
     * @param Array $parameters
     * @param String $verb
     * @param Array $headers
     * @return JSON Object
     */
    public function request($url, $parameters = [], $verb = 'get', $headers = [])
    {
        $url = $this->buildUrl($url, $parameters);
    }
}
