<?php

namespace Imdb\Fetcher;

use Imdb\Client\ClientFactoryInterface;
use Imdb\Parser\ParserInterface;

abstract class AbstractFetcher
{
    protected $parser;
    protected $httpClient;

    public function __construct(ParserInterface $parser, ClientFactoryInterface $clientFactory)
    {
        $this->parser = $parser;
        $this->httpClient = $clientFactory->createClient();
    }

    public function fetch($endpoint, $options)
    {
        $response = $this->httpClient->sendRequest($endpoint, $options);

        if ($response) {
            return $this->parser->parse($response->getBody()->getContents());
        }

        return FALSE;
    }

    abstract public function suggestId($string);
}
