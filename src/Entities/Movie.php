<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class Movie
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\Movie getId($expired = NULL)
 * @method \Imdb\Entities\Movie getTitle($expired = NULL)
 * @method \Imdb\Entities\Movie getYear($expired = NULL)
 * @method \Imdb\Entities\Movie getImage($expired = NULL)
 * @method \Imdb\Entities\Movie getRunningTimeInMinutes($expired = NULL)
 * @method \Imdb\Entities\Movie getPrincipals($expired = NULL)
 */
class Movie extends CultureItem
{
    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }
}
