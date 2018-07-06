<?php

namespace hassanalisalem\urlshortener\Tests;

use hassanalisalem\urlshortener\Core\HttpClientAdapter;
use hassanalisalem\urlshortener\Drivers\Bitly;
use hassanalisalem\urlshortener\Shortener;

class HttpClientTest extends TestCase
{

    public function testHttpClientAdapter()
    {
        $httpClient = new HttpClientAdapter;
        $response = $httpClient->prepareRequest('get', 'http://www.google.com')->send();
        $this->assertEquals($response->getStatusCode(), 200);
    }

    public function testBuildUrl()
    {
        $httpClient = new HttpClientAdapter();
        $result = $this->invokePrivate($httpClient, 'buildUrl', ['http://www.google.com', ['a' => 1]]);
        $this->assertEquals($result, 'http://www.google.com?a=1');
        $this->assertNotEquals($result, 'http://www.google.com?a=2');
    }

    public function testPrepareRequest()
    {
        $httpClient = new HttpClientAdapter();
        $request = $httpClient->prepareRequest('get', 'url', ['a' => 1]);
        $this->assertEquals($httpClient->getUrl(), 'url?a=1');
        $this->assertNotEquals($httpClient->getUrl(), 'url?a=2');
        $this->assertEquals($this->getPrivateProperty($httpClient, verb), 'GET');
        $this->assertNotEquals($this->getPrivateProperty($httpClient, verb), 'ABC');
        $this->assertEquals(get_class($httpClient), get_class($request));
    }
}
