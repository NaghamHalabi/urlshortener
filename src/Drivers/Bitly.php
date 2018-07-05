<?php

namespace hassanalisalem\urlshortener\Drivers;
use  hassanalisalem\urlshortener\Contracts\DriverInterface;

class Bitly extends Driver implements DriverInterface
{
    protected $groupsEndPoint = 'groups';
    protected $urlShortenerEndPoint = 'shorten';
    protected $baseUrl = 'https://api-ssl.bitly.com/v4';

    function __construct($config, $httpClient)
    {
        $this->accessToken = $config['access_token'];
        $this->httpClient = $httpClient;
        $this->httpClient->setHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
        ]);
    }

    public function getShortUrl(string $url): string
    {
        $shorten = $this->shorten($url);
        return $shorten['link'];
    }

    private function shorten($url)
    {
        $guid = $this->getFirstGuid();
        $jsonBody = json_encode([
            'group_guid' => $guid,
            'long_url' => $url,
        ]);
        $responseBody = $this->sendRequest($jsonBody);
        return $responseBody;
    }

    private function sendRequest($jsonBody)
    {
        $responseBody = $this->httpClient->prepareRequest(
            'post',
            $this->baseUrl.'/'. $this->urlShortenerEndPoint
        )->setBody(
            $jsonBody
        )->send()->getContents();

        return json_decode($responseBody, true);
    }

    private function getFirstGuid()
    {
        $guids = $this->getGuids();
        if(count($guids['groups']) == 0) {
            throw new \Exception ('there is no group returned');
        }

        return $guids['groups'][0]['guid'];
    }

    private function getGuids()
    {
        $content = $this->httpClient->prepareRequest(
            'get',
            $this->baseUrl.'/'.$this->groupsEndPoint
        )->send()->getContents();

        return json_decode($content, true);
    }
}
