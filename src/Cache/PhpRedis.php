<?php

namespace Imdb\Cache;

class PhpRedis extends CacheClientFactory
{
    public function create()
    {
        return new PhpRedisClient();
    }

}
