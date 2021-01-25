<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class Episode
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\Episode getId($expired = NULL)
 * @method \Imdb\Entities\Episode getNextEpisode($expired = NULL)
 * @method \Imdb\Entities\Episode getEpisode($expired = NULL)
 * @method \Imdb\Entities\Episode getImage($expired = NULL)
 * @method \Imdb\Entities\Episode getRunningTimeInMinutes($expired = NULL)
 * @method \Imdb\Entities\Episode getSeriesEndYear($expired = NULL)
 * @method \Imdb\Entities\Episode getSeriesStartYear($expired = NULL)
 * @method \Imdb\Entities\Episode getTitle($expired = NULL)
 * @method \Imdb\Entities\Episode getTitleType($expired = NULL)
 * @method \Imdb\Entities\Episode getYear($expired = NULL)
 * @method \Imdb\Entities\Episode getSeason($expired = NULL)
 * @method \Imdb\Entities\Episode getParentTitle($expired = NULL)
 */
class Episode extends CultureItem {

    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }

}
