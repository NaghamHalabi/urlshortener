<?php

namespace hassanalisalem\urlshortener\Tests;

use hassanalisalem\urlshortener\Core\HttpClientAdapter;
use hassanalisalem\urlshortener\Drivers\Bitly;
use hassanalisalem\urlshortener\Shortener;

class DriversTest extends TestCase
{

    public function testHttpClientAdapter()
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

    public function testBitlyDriver()
    {
        $httpClient = new HttpClientAdapter;
        $shortener = new Shortener([
            'access_token' => '89b2d7baf3f03936ea4e3e9400cb18a91fb2bd92',
            'driver' => 'bitly'
        ], $httpClient);
        $this->assertStringStartsWith('http', $shortener->shorten('http://www.google.com'));
    }

    public function testBcvc()
    {
        $httpClient = new HttpClientAdapter;
        $shortener = new Shortener([
            'key' => '680dd7da074edf79c5016dc1bec5fd83',
            'uid' => '253890',
            'driver' => 'bcvc',
        ], $httpClient);
        $this->assertStringStartsWith('http', $shortener->shorten('http://www.google.com'));
    }

    public function testTinycc()
    {
        $httpClient = new HttpClientAdapter;
        $shortener = new Shortener([
            'api_key' => '8bb6dc8a-0545-4c1d-b0fd-9220559fd733',
            'login' => 'hassansalem',
            'driver' => 'tinycc',
        ], $httpClient);
        $this->assertStringStartsWith('http', $shortener->shorten('http://www.google.com'));
    }
}
