<?php

namespace hassanalisalem\urlshortener\Core;

/**
 * Driver loader is responsible to load the driver.
 * it is the parent of the shortener, because it
 * loads a driver to be used in shortening.
 *
 * @category Loader
 *
 * @author   Hassan Salem <h.salem7788@gmail.com>
 */
class DriverLoader
{
    private $namespace = '\\hassanalisalem\\urlshortener\\Drivers\\';
    function __construct($config)
    {
        $this->config = $config;
    }

    public function loadDriver($name, $httpClient)
    {
        $className = $this->getClassName($name);
        if(!class_exists($className)) {
            throw new \Exception ("class {$className} does not exists");
        }
        return new $className($this->config, $httpClient);
    }

    private function getClassName($name)
    {
        return $this->namespace . ucfirst($name);
    }
}
