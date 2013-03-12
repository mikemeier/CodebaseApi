<?php

namespace mikemeier\CodebaseApi\Tests;

use mikemeier\CodebaseApi\CodebaseApi;
use mikemeier\CodebaseApi\Request\Ticket\TicketOptions;

use Payment\HttpClient\HttpClientInterface;
use Payment\HttpClient\BuzzClient;

use DateTime;

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
        //$this->assertInternalType('array', $codebaseApi->getActivityFeed()->getEvents(), 'Events not an array');
    }

    public function testGetTicketBag()
    {
        $codebaseApi = $this->getCodebaseApi();

        $ticketOptions = $codebaseApi->createTicketOptions($this->getProjectName(), array(
            TicketOptions::OPTION_RESOLUTION => TicketOptions::RESOLUTION_RESOLVED,
            TicketOptions::OPTION_UPDATE => new DateTime()
        ));

        //$this->assertInternalType('array', $codebaseApi->getTicketBag($ticketOptions)->getTickets(), 'Tickets not an array');
    }

    public function testGetTicketStatusBag()
    {
        $codebaseApi = $this->getCodebaseApi();
        //$this->assertInternalType('array', $codebaseApi->getTicketStatusBag($this->getProjectName())->getStatus(), 'TicketStatus not an array');
    }

    public function testGetTicketPriorityBag()
    {
        $codebaseApi = $this->getCodebaseApi();
        //$this->assertInternalType('array', $codebaseApi->getTicketPriorityBag($this->getProjectName())->getPriorities(), 'TicketPriority not an array');
    }

    public function testGetTicketCategoryBag()
    {
        $codebaseApi = $this->getCodebaseApi();
        //$this->assertInternalType('array', $codebaseApi->getTicketCategoryBag($this->getProjectName())->getCategories(), 'TicketPriority not an array');
    }

    public function testUpdateTicket()
    {
        $codebaseApi = $this->getCodebaseApi();

        $update = $codebaseApi->createTicketUpdate($this->getProjectName(), 19);
        $update->setContent('taxNumber weg, backend andere Übersetzung als Frontend für codiceFiscale, b2c checkbox weg, wenn IT ein Dealer erstellt: PW verstecken, JS Firma Hack weg: Immer Firma');

        //$codebaseApi->updateTicket($update);
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

    private function getProjectName()
    {
        $credentials = $this->getCredentials();
        return $credentials['projectName'];
    }
}