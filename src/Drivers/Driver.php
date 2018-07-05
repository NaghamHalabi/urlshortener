<?php

namespace hassanalisalem\urlshortener\Drivers;

abstract class Driver
{
    function __construct()
    {

    }

    /**
     * Sets the http client
     *
     * @param $httpClient
     */
    protected function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Gets the http client
     *
     * @return \hassanalisalem\urlshortener\Contracts\HttpClientInterface;
     */
    protected function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Execute the request
     *
     * @param String $url
     * @param Array $parameters
     * @param String $verb
     * @param Array $headers
     */
    public function request($url, $parameters = [], $verb = 'get', $headers = [])
    {
        $client = $this->httpClient;
        $response = $client->request($url, $parameters, $verb, $headers);
        return $response;
    }
}
