<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class TvShow
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\TvShow getId()
 * @method \Imdb\Entities\TvShow getNextEpisode()
 * @method \Imdb\Entities\TvShow getNumberOfEpisodes()
 * @method \Imdb\Entities\TvShow getImage()
 * @method \Imdb\Entities\TvShow getRunningTimeInMinutes()
 * @method \Imdb\Entities\TvShow getSeriesEndYear()
 * @method \Imdb\Entities\TvShow getSeriesStartYear()
 * @method \Imdb\Entities\TvShow getTitle()
 * @method \Imdb\Entities\TvShow getTitleType()
 * @method \Imdb\Entities\TvShow getYear()
 */
class TvShow extends CultureItem
{
    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }
}
