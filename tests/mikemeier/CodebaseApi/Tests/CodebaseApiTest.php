<?php

namespace mikemeier\CodebaseApi\Tests;

use mikemeier\CodebaseApi\CodebaseApi;
use mikemeier\CodebaseApi\Result\ActivityFeed\Event;

use Payment\HttpClient\HttpClientInterface;
use Payment\HttpClient\BuzzClient;

class CodebaseApiTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $credentials = $this->getCredentials();
        $authorization = 'Basic '. base64_encode($credentials['username'].':'.$credentials['key']);

        $httpClient = $this->getHttpClient();

        $codebaseApi = new CodebaseApi($credentials['username'], $credentials['key'], $httpClient);

        $this->assertAttributeSame($authorization, 'authorization', $codebaseApi, 'Authorization not correct');
        $this->assertAttributeSame($httpClient, 'httpClient', $codebaseApi, 'HttpClient not set');
    }

    public function testGetActivityFeed()
    {
        $codebaseApi = $this->getCodebaseApi();
        var_dump($codebaseApi->getActivityFeed()->getEvents());
    }

    /**
     * @return CodebaseApi
     */
    private function getCodebaseApi()
    {
        $credentials = $this->getCredentials();
        $httpClient = $this->getHttpClient();

        return new CodebaseApi($credentials['username'], $credentials['key'], $httpClient);
    }

    /**
     * @return HttpClientInterface
     */
    private function getHttpClient()
    {
        return new BuzzClient();
    }

    /**
     * @return array
     */
    private function getCredentials()
    {
        return require __DIR__.'/../../../../credentials.php';
    }
}