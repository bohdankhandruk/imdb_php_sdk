<?php

namespace Imdb\Cache;

class PhpRedisClient implements CacheClientInterface
{
    protected $client;

    public function __construct() {
        $this->client = new \Redis();
    }

    public function connect($host, $port, $timeout, $interval)
    {
        return $this->client->connect($host, $port, $timeout, $interval);
    }

    public function get($key)
    {
        return $this->client->get($key);
    }

    public function getMultiple($keys)
    {
        return $this->client->mget($keys);
    }

    public function set($key, $value)
    {
        return $this->client->set($key, $value);
    }

    public function setWithExpiration($key, $time, $value)
    {
        return $this->client->setex($key, $time, $value);
    }

    public function expire($key, $time)
    {
        return $this->client->expire($key, $time);
    }

    public function delete($key)
    {
        return $this->client->del($key);
    }

    public function exists($key)
    {
        return $this->client->exists($key);
    }

    public function close()
    {
        return $this->client->close();
    }

}
