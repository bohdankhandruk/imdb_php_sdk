<?php

namespace Imdb\Fetcher;

use Imdb\Cache\CacheClientFactory;
use Imdb\Client\ClientFactoryInterface;
use Imdb\Parser\ParserInterface;

abstract class AbstractFetcher
{
    protected $parser;
    protected $httpClient;
    protected $cacheClient;

    public function __construct(ParserInterface $parser, ClientFactoryInterface $clientFactory, CacheClientFactory $cacheClientFactory = NULL)
    {
        $this->parser = $parser;
        $this->httpClient = $clientFactory->createClient();
        $this->cacheClient = $cacheClientFactory->create();
    }

    public function fetch($endpoint, $options, $cacheConfig = [])
    {
        if ($this->cacheClient && $cacheConfig) {
            // @todo move this to concrete cache client.
            list('host' => $host, 'port' => $port, 'timeout' => $timeout, 'interval' => $interval) = $cacheConfig;

            $this->cacheClient->connect($host, $port, $timeout, $interval);

            $cacheKey = $endpoint . ':' . json_encode($options);

            if (!$response = $this->cacheClient->get($cacheKey)) {
                $response = $this->httpClient->sendRequest($endpoint, $options);

                // @todo figure out which endpoints should be cached with expiration.
                $this->cacheClient->set($cacheKey, $response);
            }
        }
        else {
            $response = $this->httpClient->sendRequest($endpoint, $options);
        }

        if ($response) {
            return $this->parser->parse($response->getBody()->getContents());
        }

        return FALSE;
    }

    abstract public function suggestId($string);
}
