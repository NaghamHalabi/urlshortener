<?php

namespace hassanalisalem\urlshortener\Contracts;

interface HttpClientInterface
{
    public function prepareRequest($verb, $url, $parameters = []);
    public function setHeaders($headers);
    public function setBody($body);
    public function send();
    public function getStatusCode();
    public function getBody();
}
