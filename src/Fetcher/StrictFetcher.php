<?php

namespace Imdb\Fetcher;

class StrictFetcher extends AbstractFetcher
{

  public function suggestId($string)
  {
    $data = $this->fetch('/title/find', ['q' => $string]);
    $id = isset($data->results[0]->id) ? $data->results[0]->id : '';

    if (preg_match('/^\/(name|title)\/(.+)\/$/', $id, $matches) && $data->results[0]->{$matches[1]} == $string) {
      return $matches[2];
    }

    return FALSE;
  }

}
