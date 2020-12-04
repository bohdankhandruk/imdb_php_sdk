<?php

namespace Imdb\Client\ApiDojo;

class Request
{
    protected $credentials;

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function buildOptions(array $queryOptions = []) {
        return [
            'headers' => $this->buildHeaders(),
            'query' => $queryOptions,
        ];
    }

    private function buildHeaders() {
        return [
            'x-rapidapi-key' => $this->credentials->key,
            'x-rapidapi-host' => $this->credentials->getHost(),
            'useQueryString' => TRUE,
        ];
    }

    public function getEndpoint($uri) {
        return $this->credentials->baseUri->getTemplate() . $uri;
    }

    public function getMethod($method = 'GET') {
        return $method;
    }
}
