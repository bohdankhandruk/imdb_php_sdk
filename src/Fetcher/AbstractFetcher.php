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

    abstract public function fetch($endpoint, $options);
    abstract public function suggestId($string);
}
