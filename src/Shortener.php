<?php

namespace hassanalisalem\urlshortener;

use hassanalisalem\urlshortener\Contracts\HttpClientInterface;
use hassanalisalem\urlshortener\Core\HttpClientAdapter;
use hassanalisalem\urlshortener\Core\DriverLoader;

/**
 * This class is the main entry point of the package
 * it just select a driver and send the url to it
 *
 * @category Shortener
 *
 * @author   Hassan Salem <h.salem7788@gmail.com>
 */
class Shortener extends DriverLoader
{

    /**
     * Create new instance of shortener.
     * And inject needed dependancies
     * as httpClient and the driver
     *
     * @param Array $config
     * @param HttpClientInterface $httpClient
     */
    function __construct(array $config, HttpClientInterface $httpClient = null)
    {
        if($httpClient == null) {
            $httpClient = new HttpClientAdapter;
        }

        $this->config = $config;
        $this->httpClient = $httpClient;
        $this->driverName = $this->config['driver'];
        $this->driver = $this->loadDriver($this->driverName, $this->httpClient);
        unset($this->config['driver']);
    }

    /**
     * shorten a url
     *
     * @param url $url
     * @return string url
     */
    public function shorten(string $url)
    {
        return $this->driver->getShortUrl($url);
    }
}
