<?php

namespace hassanalisalem\urlshortener\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use hassanalisalem\urlshortener\Contracts\HttpClientInterface;

/**
 * This class a Http Client wrapper
 *
 *
 * @category HttpClient Wrapper
 *
 * @author   Hassan Salem <h.salem7788@gmail.com>
 */
class HttpClientAdapter implements HttpClientInterface
{

    /**
     * http version
     *
     * @var string
     */
    protected $version = '1.1';

    /**
     * http request default data
     *
     * @var Array
     */
    protected $data = [];

    /**
     * http request default body
     *
     * @var string
     */
    protected $body = '';

    /**
     * http request headers default
     *
     * @var Array
     */
    protected $headers = [];

    /**
     * http request url to be sent to
     *
     * @var string
     */
    protected $url;

    /**
     * http request verb default value
     *
     * @var string
     */
    protected $verb = 'get';

    /**
     * create new instance of http client adapter
     * this should be enhanced to make it easy
     * to change the http client if needed
     */
    function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Build url with parameters
     *
     * @param String $url
     * @param Array $parameters
     * @return String
     */
    private function buildUrl($url, $parameters = [])
    {
        return $url.'?'.join('&', array_map(function ($key, $value) {
            return "$key=$value";
        }, array_keys($parameters), $parameters));
    }

    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sends the request to the url
     *
     * @param String $url
     * @param Array $parameters
     * @param String $verb
     * @param Array $headers
     * @return JSON Object
     */
    public function prepareRequest($verb, $url, $parameters = [])
    {
        $url = $this->buildUrl($url, $parameters);
        $verb = strtoupper($verb);
        $this->url = $url;
        $this->verb = $verb;
        return $this;
    }

    /**
     * set request headers as array
     *
     * @param Array $headers
     * @return HttpClientAdapter $this [for chaining]
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
        return $this;
    }

    /**
     * set data when send form
     *
     * @param Array $data
     * @return HttpClientAdapter $this
     */
    public function setData($data)
    {
        $this->data = data;
        return $this;
    }

    /**
     * set request body
     *
     * @param String $body
     * @return HttpClientAdapter $this
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * send the request
     *
     * @return HttpClientAdapter $this
     */
    public function send()
    {
        $this->response = $this->client->request(
            $this->verb,
            $this->url,
            [
                'headers' => $this->headers,
                'body' => $this->body,
                'version' => $this->version,
            ]
        );

        return $this;
    }

    /**
     * get response status code
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }

    /**
     * get response Body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->response->getBody();
    }

    /**
     * get response content
     *
     * @return string
     */
    public function getContents()
    {
        return $this->getBody()->getContents();
    }
}
