<?php

namespace hassanalisalem\urlshortener\Drivers;

abstract class Driver
{
    protected $httpClient;

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
}
