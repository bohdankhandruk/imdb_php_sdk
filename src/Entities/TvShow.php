<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class TvShow
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\TvShow getId($expired = NULL)
 * @method \Imdb\Entities\TvShow getNextEpisode($expired = NULL)
 * @method \Imdb\Entities\TvShow getNumberOfEpisodes($expired = NULL)
 * @method \Imdb\Entities\TvShow getImage($expired = NULL)
 * @method \Imdb\Entities\TvShow getRunningTimeInMinutes($expired = NULL)
 * @method \Imdb\Entities\TvShow getSeriesEndYear($expired = NULL)
 * @method \Imdb\Entities\TvShow getSeriesStartYear($expired = NULL)
 * @method \Imdb\Entities\TvShow getTitle($expired = NULL)
 * @method \Imdb\Entities\TvShow getTitleType($expired = NULL)
 * @method \Imdb\Entities\TvShow getYear($expired = NULL)
 */
class TvShow extends CultureItem
{
    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }
}
