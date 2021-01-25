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
    protected $cacheConfig;

    public function __construct(ParserInterface $parser, ClientFactoryInterface $clientFactory, CacheClientFactory $cacheClientFactory = NULL, array $cacheConfig = [])
    {
        $this->parser = $parser;
        $this->httpClient = $clientFactory->createClient();

        $this->cacheClient = $cacheClientFactory ? $cacheClientFactory->create() : null;
        $this->cacheConfig = $cacheConfig;
    }

    public function fetch($endpoint, $options, $expired = NULL)
    {
        $data = FALSE;

        if ($this->cacheClient && $this->cacheConfig) {
            // @todo move this to concrete cache client.
            list('host' => $host, 'port' => $port, 'timeout' => $timeout, 'interval' => $interval) = $this->cacheConfig;

            $this->cacheClient->connect($host, $port, $timeout, $interval);

            $cacheKey = $endpoint . ':' . json_encode($options);

            if (!$data = $this->cacheClient->get($cacheKey)) {

                $response = $this->httpClient->sendRequest($endpoint, $options);
                if ($response) {
                    $data = $this->parser->parse($response->getBody()->getContents());
                }

                if (isset($expired)) {
                  $this->cacheClient->setWithExpiration($cacheKey, json_encode($data), $expired);
                }
                else {
                  $this->cacheClient->set($cacheKey, json_encode($data));
                }
            }
            else {
              $data = json_decode($data);
            }
        }
        else {
            $response = $this->httpClient->sendRequest($endpoint, $options);
            if ($response) {
                $data = $this->parser->parse($response->getBody()->getContents());
            }
        }

        return $data;
    }

    abstract public function suggestId($string);
}
