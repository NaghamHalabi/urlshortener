<?php

namespace hassanalisalem\urlshortener\Drivers;
use  hassanalisalem\urlshortener\Contracts\DriverInterface;

/**
 * Driver class, every driver class is responsible on the
 * specific implementation of the service it presents
 *
 * @category Driver
 *
 * @author   Hassan Salem <h.salem7788@gmail.com>
 */
class Bcvc extends Driver implements DriverInterface
{
    protected $baseUrl = 'http://bc.vc/api.php';

    /**
     * creates new instance of the driver,
     * and prepare all the dependencies.
     *
     * @param Array $config
     * @param HttpClientInterface $httpClient
     */
    function __construct($config, $httpClient)
    {
        $this->key = $config['key'];
        $this->uid = $config['uid'];

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
        $shorten = $this->getLinkData($url);
        return $shorten;
    }


    /**
     *
     * @param string $jsonBody
     * @return Array
     */
    private function getLinkData($url)
    {
        $responseBody = $this->httpClient->prepareRequest(
            'get',
            $this->baseUrl,
            [
                'key' => $this->key,
                'uid' => $this->uid,
                'url' => $url
            ]
        )->send()->getContents();

        return $responseBody;
    }
}
