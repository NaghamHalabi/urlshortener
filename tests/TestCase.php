<?php

namespace hassanalisalem\urlshortener\Tests;

use PHPUnit\Framework\TestCase as PHPUnit;

class TestCase extends PHPUnit
{
    public function __construct()
    {
        parent::__construct();
    }

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function getPrivateProperty($object, $propertyName)
    {
        $reflector = new \ReflectionClass(get_class($object));
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($object);
    }

    public function invokePrivate($object, $methodName, ...$args)
    {
        $reflector = new \ReflectionClass(get_class($object));
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);
        $result = $method->invokeArgs($object, ...$args);
        return $result;
    }

}
