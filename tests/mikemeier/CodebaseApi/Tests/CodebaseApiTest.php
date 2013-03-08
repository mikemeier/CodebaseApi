<?php

namespace mikemeier\CodebaseApi\Tests;

use Payment\HttpClient\HttpClientInterface;

use mikemeier\CodebaseApi\CodebaseApi;
use Payment\HttpClient\BuzzClient;

class CodebaseApiTest extends \PHPUnit_Framework_TestCase
{
    public function testCredentials()
    {
        $credentials = $this->getCredentials();
        $httpClient = $this->getHttpClient();

        $codebaseApi = new CodebaseApi($credentials['username'], $credentials['key'], $httpClient);

        $this->assertAttributeSame($credentials['username'], 'username', $codebaseApi, 'Username not saved');
        $this->assertAttributeSame($credentials['key'], 'key', $codebaseApi, 'Key not saved');
        $this->assertAttributeSame($httpClient, 'httpClient', $codebaseApi, 'HttpClient not saved');
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