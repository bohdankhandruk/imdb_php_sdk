<?php

namespace Imdb\Fetcher;

class BaseFetcher extends AbstractFetcher
{

    public function suggestId($string)
    {
        $data = $this->fetch('/title/find', ['q' => $string]);

        $index = 0;
        foreach ($data->results as $key => $result) {
            // @todo pass the enity type and compare with 'titleType'.
            if ($result->title == $string) {
                $index = $key;
                break;
            }
        }

        $id = isset($data->results[$index]->id) ? $data->results[$index]->id : '';

        if (preg_match('/^\/(?>name|title)\/(.+)\/$/', $id, $matches)) {
            return $matches[1];
        }

        return FALSE;
    }

}
