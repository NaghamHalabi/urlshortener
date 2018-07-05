<?php

namespace hassanalisalem\urlshortener\Tests;

use hassanalisalem\urlshortener\Core\HttpClientAdapter;
use hassanalisalem\urlshortener\Drivers\Bitly;

class AbcTest extends TestCase
{

    public function testHassan()
    {
        $httpClient = new HttpClientAdapter;
        $response = $httpClient->prepareRequest('get', 'http://www.google.com')->send();
        $this->assertEquals($response->getStatusCode(), 200);
    }

    public function testBitly()
    {
        $httpClient = new HttpClientAdapter;
        $bitly = new Bitly([
            'access_token' => '89b2d7baf3f03936ea4e3e9400cb18a91fb2bd92',
        ], $httpClient);
        $url = $bitly->getShortUrl('http://www.google.com');
        $this->assertStringStartsWith('http', $url);
    }

}
