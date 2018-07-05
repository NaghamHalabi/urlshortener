<?php

namespace hassanalisalem\urlshortener\Drivers;

class Bitly extends Driver
{
    function __construct($config, $httpClient)
    {
        $this->setHttpClient($httpClient);
    }

    public function shorten($url)
    {
        $guid = $this->getGuid();
        $jsonBody = json_encode([
            'guid' => $guid,
            'url' => $url,
        ]);
    }

    private function getGuid()
    {

    }
}
