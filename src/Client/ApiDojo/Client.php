<?php

namespace Imdb\Client\ApiDojo;

use Imdb\Client\ClientInterface;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Exception\GuzzleException;

class Client implements ClientInterface
{
    protected $httpClient;
    protected $credentials;

    /**
     * @var \Imdb\Client\ApiDojo\Request
     */
    private $request;

    public function __construct(GuzzleClientInterface $httpClient, Credentials $credentials)
    {
        $this->httpClient = $httpClient;
        $this->credentials = $credentials;
    }

    private function createRequest() {
        $this->request = new Request($this->credentials);
    }

    public function sendRequest($uri, array $queryOptions = [])
    {
        try {
            $this->createRequest();

            return $this->httpClient->request(
                $this->request->getMethod(),
                $this->request->getEndpoint($uri),
                $this->request->buildOptions($queryOptions)
            );
        }
        catch (GuzzleException $exception) {
            // @TODO log somewhere.
        }

        return NULL;
    }

}
