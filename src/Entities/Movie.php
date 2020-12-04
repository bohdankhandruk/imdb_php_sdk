<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class Movie
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\Movie getId()
 * @method \Imdb\Entities\Movie getTitle()
 * @method \Imdb\Entities\Movie getYear()
 * @method \Imdb\Entities\Movie getImage()
 * @method \Imdb\Entities\Movie getRunningTimeInMinutes()
 * @method \Imdb\Entities\Movie getPrincipals()
 */
class Movie extends CultureItem
{
    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }
}
