<?php

namespace hassanalisalem\urlshortener\Contracts;

use Psr\Http\Message\StreamInterface;

interface HttpClientInterface
{
    public function prepareRequest(string $verb, string $url, array $parameters = []): HttpClientInterface;
    public function setHeaders(array $headers): HttpClientInterface;
    public function setBody(string $body): HttpClientInterface;
    public function send(): HttpClientInterface;
    public function getStatusCode(): int;
    public function getBody(): StreamInterface;
}
