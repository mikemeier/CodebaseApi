<?php

namespace mikemeier\CodebaseApi;

use Payment\HttpClient\HttpClientInterface;
use Payment\HttpClient\ResponseInterface;

use mikemeier\CodebaseApi\Result\ActivityFeed\ActivityFeed;

use mikemeier\CodebaseApi\Exception\AccessDeniedException;
use mikemeier\CodebaseApi\Exception\NotFoundException;
use mikemeier\CodebaseApi\Exception\UnprocessableEntityException;

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
     * @param $url
     * @return ResponseInterface
     * @throws InvalidStatusCodeException
     * @throws UnprocessableEntityException
     * @throws NotFoundException
     * @throws AccessDeniedException
     */
    protected function request($url)
    {
        $response = $this->httpClient->request(HttpClientInterface::METHOD_GET, $url, null, array(
            self::HTTP_AUTH_BASIC_HEADER.': '. $this->authorization
        ));

        $statusCode = $response->getStatusCode();
        switch($statusCode) {
            case 200:
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

    /**
     * @param string $projectName
     * @return string
     */
    protected function getActivityFeedUrl($projectName = null)
    {
        $suffix = '/activity';
        if(!$projectName){
            return $this->getCodebaseUrl().$suffix;
        }
        return $this->getCodebaseUrl().'/'.$projectName.$suffix;
    }

    /**
     * @return string
     */
    protected function getCodebaseUrl()
    {
        return self::CODEBASE_URL;
    }
}