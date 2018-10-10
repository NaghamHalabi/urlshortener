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
class Bitly extends Driver implements DriverInterface
{
    protected $groupsEndPoint = 'groups';
    protected $urlShortenerEndPoint = 'shorten';
    protected $baseUrl = 'https://api-ssl.bitly.com/v4';

    function __construct(array $config, HttpClientInterface $httpClient)
    {
        $this->accessToken = $config['access_token'];
        $this->httpClient = $httpClient;
        $this->httpClient->setHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ]);
    }

    /**
     * Get a short url
     *
     * @param string $url
     * @return string
     */
    public function getShortUrl(string $url): string
    {
        $shorten = $this->shorten($url);
        return $shorten['link'];
    }

    /**
     * shorten
     *
     */
    public function shorten(string $url)
    {
        $guid = $this->getFirstGuid();
        $jsonBody = json_encode([
            'group_guid' => $guid,
            'long_url' => $url,
        ]);
        $responseBody = $this->getLinkData($jsonBody);
        return $responseBody;
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
            'post',
            $this->baseUrl.'/'. $this->urlShortenerEndPoint
        )->setBody(
            $jsonBody
        )->send()->getContents();

        return json_decode($responseBody, true);
    }

    /**
     * Get first group guid, or throw an error if not exists
     *
     * @return string
     */
    private function getFirstGuid()
    {
        $guids = $this->getGuids();
        if(count($guids['groups']) == 0) {
            throw new \Exception ('there is no group returned');
        }

        return $guids['groups'][0]['guid'];
    }

    /**
     * get groups ids, to shorten a url in bitly
     * a group_id is required with the url.
     *
     * @return Array
     */
    private function getGuids()
    {
        $content = $this->httpClient->prepareRequest(
            'get',
            $this->baseUrl.'/'.$this->groupsEndPoint
        )->send()->getContents();

        return json_decode($content, true);
    }
}
