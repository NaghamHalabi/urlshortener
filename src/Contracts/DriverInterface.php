<?php

namespace hassanalisalem\urlshortener\Contracts;

interface DriverInterface
{
    public function getShortUrl(string $url): string;
}
