<?php

namespace hassanalisalem\urlshortener\Tests;
use hassanalisalem\urlshortener\Core\HttpClientAdapter;

class AbcTest extends TestCase
{

    public function testHassan()
    {
        $httpClient = new HttpClientAdapter;
        $this->assertEquals($httpClient->buildUrl('abc', ['a' => 1, 'b' => 2]), 'abc?a=1&b=2');
        $this->assertNotEquals($httpClient->buildUrl(['a' => 1, 'b' => 2]), 'abc?a=1&b=3');
    }

}
