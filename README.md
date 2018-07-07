# PHP URL Shortener
Just a library to shorten url using different url shortener services, for now bitly.com, bc.vc and tiny.cc are implemented.
a lot coming soon.
## Installation

    composer require hassanalisalem/urlshortener

## Usage

    // bitly config
    $config = [
        'access_token' => '',
        'driver' => 'bitly',
    ];
    $shortener = new hassanalisalem\urlshortener\Shortener($config);
    $shortener->shorten($url);

## drivers
#### bitly.com

    $config = [
        'access_token' => '',
        'driver' => 'bitly',
    ];
#### Bc.vc

    $config = [
        'key' => '',
        'uid' => '',
        'driver' => 'bcvc',
    ];
#### Tiny.cc

    $config = [
        'api_key' => '',
        'login' => '',
        'driver' => 'tinycc',
    ];

### To create a new driver
Driver class should extends **Driver** abstract class, and it should implements **DriverInterface**.

Driver Class Name should be as the driver name with capital first letter.

example driver for **google**; class name should be **Google**
