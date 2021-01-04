<?php

namespace Imdb\Cache;

class PhpRedisClient implements CacheClientInterface
{
    protected $client;

    public function __construct() {
        $this->client = new Redis();
    }

    public function connect($host, $port, $timeout, $interval)
    {
        $this->client->connect($host, $port, $timeout, $interval);
    }

    public function get($key)
    {
        $this->client->get($key);
    }

    public function getMultiple($keys)
    {
        $this->client->mget($keys);
    }

    public function set($key, $value)
    {
        $this->client->set($key, $value);
    }

    public function setWithExpiration($key, $time, $value)
    {
        $this->client->setex($key, $time, $value);
    }

    public function delete($key)
    {
        $this->client->del($key);
    }

    public function exists($key)
    {
        $this->client->exists($key);
    }

    public function close()
    {
        $this->client->close();
    }

}
