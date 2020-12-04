<?php

namespace Imdb\Client\ApiDojo;

use League\Uri\Contracts\UriException;
use League\Uri\UriTemplate;

class Credentials
{

    public $baseUri;
    public $key;
    public $useQueryString;

    public function __construct(UriTemplate $baseUri, $key, $useQueryString)
    {
        $this->baseUri = $baseUri;
        $this->key = $key;
        $this->useQueryString = $useQueryString;
    }

    public function getHost() {
        try {
            return $this->baseUri->expand()->getAuthority();
        }
        catch (UriException $exception) {
            // @TODO log.
        }
    }

}
