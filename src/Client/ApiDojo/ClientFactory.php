<?php

namespace Imdb\Client\ApiDojo;

use Imdb\Client\ClientFactoryInterface;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;

class ClientFactory implements ClientFactoryInterface
{
    protected $httpClient;
    protected $credentials;

    public function __construct(GuzzleClientInterface $httpClient, Credentials $credentials)
    {
        $this->httpClient = $httpClient;
        $this->credentials = $credentials;
    }

    public function createClient()
    {
        return new Client($this->httpClient, $this->credentials);
    }

}
