<?php

namespace mikemeier\CodebaseApi;

use Payment\HttpClient\HttpClientInterface;
use Payment\HttpClient\ResponseInterface;

use mikemeier\CodebaseApi\Result\Ticket\TicketBag;
use mikemeier\CodebaseApi\Result\Ticket\TicketStatusBag;
use mikemeier\CodebaseApi\Result\Ticket\TicketPriorityBag;
use mikemeier\CodebaseApi\Result\Ticket\TicketCategoryBag;
use mikemeier\CodebaseApi\Result\ActivityFeed\ActivityFeed;

use mikemeier\CodebaseApi\Request\Schema;
use mikemeier\CodebaseApi\Request\Ticket\TicketOptions;
use mikemeier\CodebaseApi\Request\Ticket\TicketUpdate;

use mikemeier\CodebaseApi\Exception\AccessDeniedException;
use mikemeier\CodebaseApi\Exception\NotFoundException;
use mikemeier\CodebaseApi\Exception\UnprocessableEntityException;
use mikemeier\CodebaseApi\Exception\InvalidStatusCodeException;

class CodebaseApi implements CodebaseApiInterface
{
    /**
     * @var string
     */
    protected $authorization;

    /**
     * @var HttpClientInterface
     */
    protected $httpClient;

    /**
     * @param string $username
     * @param string $key
     * @param HttpClientInterface $httpClient
     * @param string $codebaseUrl
     */
    public function __construct($username, $key, HttpClientInterface $httpClient, $codebaseUrl = self::CODEBASE_URL)
    {
        $this->authorization = 'Basic '. base64_encode($username.':'.$key);
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $projectName
     * @return ActivityFeed
     */
    public function getActivityFeed($projectName = null)
    {
        return new ActivityFeed($this->request($this->getActivityFeedUrl($projectName)));
    }

    /**
     * @param TicketOptions $options
     * @return TicketBag
     */
    public function getTicketBag(TicketOptions $options)
    {
        /* @var TicketBag[] $ticketBags */
        $ticketBags = array();
        try {
            $page = 1;
            while(true){
                $url = $this->getTicketUrl($options, $page);
                $response = $this->request($url);
                $ticketBags[] = new TicketBag($response);
                $page++;
            }
        }catch(NotFoundException $e){}

        $tickets = array();
        foreach($ticketBags as $receivedTicketBags){
            $tickets = array_merge($receivedTicketBags->getTickets(), $tickets);
        }

        $ticketBag = new TicketBag();
        $ticketBag->setTickets($tickets);

        return $ticketBag;
    }

    /**
     * @param string $projectName
     * @param array $options
     * @return TicketOptions
     */
    public function createTicketOptions($projectName, array $options = array())
    {
        return new TicketOptions($projectName, $options);
    }

    /**
     * @param string $projectName
     * @return TicketStatusBag
     */
    public function getTicketStatusBag($projectName)
    {
        return new TicketStatusBag($this->request($this->getTicketStatusesUrl($projectName)));
    }

    /**
     * @param string $projectName
     * @return TicketPriorityBag
     */
    public function getTicketPriorityBag($projectName)
    {
        return new TicketPriorityBag($this->request($this->getTicketPrioritiesUrl($projectName)));
    }

    /**
     * @param string $projectName
     * @return TicketCategoryBag
     */
    public function getTicketCategoryBag($projectName)
    {
        return new TicketCategoryBag($this->request($this->getTicketCategoriesUrl($projectName)));
    }

    /**
     * @param TicketUpdate $ticketUpdate
     * @return bool
     */
    public function updateTicket(TicketUpdate $ticketUpdate)
    {
        $xml = $ticketUpdate->getXML();

        $this->request(
            $this->getTicketUpdateUrl($ticketUpdate->getProjectName(), $ticketUpdate->getTicketId()),
            HttpClientInterface::METHOD_POST,
            $xml,
            array(
                'Content-Type: application/xml',
                'Content-Length: '. strlen($xml)
            )
        );

        return true;
    }

    /**
     * @param string $projectName
     * @param int $ticketId
     * @param Schema $schema
     * @return TicketUpdate
     */
    public function createTicketUpdate($projectName, $ticketId, Schema $schema = null)
    {
        return new TicketUpdate($projectName, $ticketId, $schema);
    }

    /**
     * @param string $projectName
     * @param string $ticketId
     * @return string
     */
    protected function getTicketUpdateUrl($projectName, $ticketId)
    {
        return $this->getCodebaseUrl().'/'. $projectName .'/tickets/'. $ticketId.'/notes';
    }

    /**
     * @param string $projectName
     * @return string
     */
    protected function getTicketStatusesUrl($projectName)
    {
        return $this->getCodebaseUrl().'/'. $projectName .'/tickets/statuses?format=json';
    }

    /**
     * @param string $projectName
     * @return string
     */
    protected function getTicketPrioritiesUrl($projectName)
    {
        return $this->getCodebaseUrl().'/'. $projectName .'/tickets/priorities?format=json';
    }

    /**
     * @param string $projectName
     * @return string
     */
    protected function getTicketCategoriesUrl($projectName)
    {
        return $this->getCodebaseUrl().'/'. $projectName .'/tickets/categories?format=json';
    }

    /**
     * @param string $projectName
     * @return string
     */
    protected function getActivityFeedUrl($projectName = null)
    {
        $suffix = '/activity?format=json';
        if(!$projectName){
            return $this->getCodebaseUrl().$suffix;
        }
        return $this->getCodebaseUrl().'/'.$projectName.$suffix;
    }

    /**
     * @param TicketOptions $options
     * @param int $page
     * @return string
     */
    protected function getTicketUrl(TicketOptions $options, $page = 1)
    {
        return $this->getCodebaseUrl().'/'.$options->getProjectName().'/tickets?format=json&page='. $page .'&query='. $options->getQuery();
    }

    /**
     * @return string
     */
    protected function getCodebaseUrl()
    {
        return self::CODEBASE_URL;
    }

    /**
     * @param string $url
     * @param string $method
     * @param string $content
     * @param array $headers
     * @return ResponseInterface
     * @throws UnprocessableEntityException
     * @throws NotFoundException
     * @throws InvalidStatusCodeException
     * @throws AccessDeniedException
     */
    protected function request($url, $method = HttpClientInterface::METHOD_GET, $content = null, array $headers = array())
    {
        $headers = array_merge($headers, array(
            self::HTTP_AUTH_BASIC_HEADER.': '. $this->authorization
        ));

        $response = $this->httpClient->request($method, $url, $content, $headers);
        $statusCode = $response->getStatusCode();

        switch($statusCode) {
            case 200:
            case 201:
                return $response;
                break;
            case 401:
                throw new AccessDeniedException("Bad credentials");
                break;
            case 404:
                throw new NotFoundException($response->getContent());
                break;
            case 422:
                throw new UnprocessableEntityException($response->getContent());
                break;
            default:
                throw new InvalidStatusCodeException("Statuscode $statusCode invalid");
                break;
        }
    }
}