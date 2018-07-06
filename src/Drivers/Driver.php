<?php

namespace hassanalisalem\urlshortener\Drivers;

/**
 * the driver abstract class, here should be the validation
 * of every thing inside every driver 
 * TODO: implement validation
 *
 * @category Driver
 *
 * @author   Hassan Salem <h.salem7788@gmail.com>
 */
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
