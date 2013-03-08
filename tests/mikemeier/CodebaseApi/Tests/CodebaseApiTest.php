<?php

namespace mikemeier\CodebaseApi\Tests;

use mikemeier\CodebaseApi\CodebaseApi;
use mikemeier\CodebaseApi\Request\Ticket\TicketOptions;

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
        $this->assertInternalType('array', $codebaseApi->getActivityFeed()->getEvents(), 'Events not an array');
    }

    public function testGetTicketBag()
    {
        $codebaseApi = $this->getCodebaseApi();

        $ticketOptions = $codebaseApi->createTicketOptions('key-of-aurora-koa', array(
            'assignee' => TicketOptions::ASSIGNEE_ME
        ));

        print_r($codebaseApi->getTicketBag($ticketOptions)->getTickets());
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