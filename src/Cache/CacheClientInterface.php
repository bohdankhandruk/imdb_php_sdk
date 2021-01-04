<?php

namespace Imdb\Cache;

interface CacheClientInterface
{
    public function connect($host, $port, $timeout, $interval);
    public function get($key);
    public function getMultiple($keys);
    public function set($key, $value);
    public function setWithExpiration($key, $time, $value);
    public function delete($key);
    public function exists($key);
    public function close();
}