<?php

namespace hassanalisalem\urlshortener\Drivers;

use hassanalisalem\urlshortener\Contracts\HttpClientInterface;
use  hassanalisalem\urlshortener\Contracts\DriverInterface;

/**
 * Driver class, every driver class is responsible on the
 * specific implementation of the service it presents
 *
 * @category Driver
 *
 * @author   Hassan Salem <h.salem7788@gmail.com>
 */
class Tinycc extends Driver implements DriverInterface
{
    protected $groupsEndPoint = 'groups';
    protected $urlShortenerEndPoint = 'shorten';
    protected $baseUrl = 'https://tiny.cc';

    function __construct(array $config, HttpClientInterface $httpClient)
    {
        $this->apiKey = $config['api_key'];
        $this->login = $config['login'];
        $this->version = $config['version']?: '2.0.3';
        $this->format = $config['format']?: 'json';
        $this->httpClient = $httpClient;
    }

    /**
     * Get a short url
     *
     * @param string $url
     * @return string
     */
    public function getShortUrl(string $url): string
    {
        $this->url = $url;
        $responseBody = $this->getLinkData($jsonBody);
        return $responseBody['results']['short_url'];
    }

    /**
     * Send the request to shorten a url to bitly
     *
     * @param string $jsonBody
     * @return Array
     */
    private function getLinkData($jsonBody)
    {
        $responseBody = $this->httpClient->prepareRequest(
            'get',
            $this->baseUrl,
            [
                'apiKey' => $this->apiKey,
                'format' => $this->format,
                'login' => $this->login,
                'version' => $this->version,
                'c' => 'rest_api',
                'm' => 'shorten',
                'longUrl' => $this->url,
            ]
        )->send()->getContents();

        return json_decode($responseBody, true);
    }


}
