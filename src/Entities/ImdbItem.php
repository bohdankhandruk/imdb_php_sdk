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
        if (!preg_match('/^(?>nm|tt)\d+$/', $string)) {
            $string = $this->fetcher->suggestId($string);
        }
        $this->data = $this->fetcher->fetch($endpoint, [$idOption => $string]);
    }

    public function getPureId() {
        if (preg_match('/^\/(?>name|title)\/(.+)\/$/', $this->getId(), $matches)) {
            return $matches[1];
        }

        return FALSE;
    }
}
