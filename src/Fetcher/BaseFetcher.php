<?php

namespace Imdb\Fetcher;

class BaseFetcher extends AbstractFetcher
{

    public function suggestId($string)
    {
        $data = $this->fetch('/title/find', ['q' => $string]);
        $id = isset($data->results[0]->id) ? $data->results[0]->id : '';

        if (preg_match('/^\/(?>name|title)\/(.+)\/$/', $id, $matches)) {
            return $matches[1];
        }

        return FALSE;
    }

}
