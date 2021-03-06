<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

abstract class ImdbItem
{
    protected $fetcher;
    protected $data;

    public function __construct(BaseFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    public function __call($name, $arguments) {
        $property = preg_replace_callback('/^get(.)(.+)$/', function ($matches) {
            return strtolower($matches[1]) . $matches[2];
        }, $name);

        return isset($this->data->{$property}) ? $this->data->{$property} : NULL;
    }

    public function retrieveData($string, $endpoint, $idOption) {
        if (!$string) {
            throw new \Exception('The string to retrieve data on is not provided or invalid.');
        }

        if (!preg_match('/^(?>nm|tt)\d+$/', $string)) {
            $string = $this->fetcher->suggestId($string);
        }

        if (!$this->data = $this->fetcher->fetch($endpoint, [$idOption => $string])) {
            throw new \Exception('The IMDB item data is not retrieved due to empty response.');
        }
    }

    public function getPureId() {
        if (preg_match('/^\/(?>name|title)\/(.+)\/$/', $this->getId(), $matches)) {
            return $matches[1];
        }

        return FALSE;
    }
}
