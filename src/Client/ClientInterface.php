<?php

namespace Imdb\Client;

use Imdb\Client\ApiDojo\Options;

interface ClientInterface
{
    public function sendRequest($uri, array $options = []);
}
