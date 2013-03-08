<?php

namespace mikemeier\CodebaseApi;

use Payment\HttpClient\HttpClientInterface;

class CodebaseApi
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @param string $username
     * @param string $key
     * @param HttpClientInterface $httpClient
     */
    public function __construct($username, $key, HttpClientInterface $httpClient)
    {
        $this->username = $username;
        $this->key = $key;
        $this->httpClient = $httpClient;
    }
}