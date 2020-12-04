<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class Episode
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\Episode getId()
 * @method \Imdb\Entities\Episode getNextEpisode()
 * @method \Imdb\Entities\Episode getEpisode()
 * @method \Imdb\Entities\Episode getImage()
 * @method \Imdb\Entities\Episode getRunningTimeInMinutes()
 * @method \Imdb\Entities\Episode getSeriesEndYear()
 * @method \Imdb\Entities\Episode getSeriesStartYear()
 * @method \Imdb\Entities\Episode getTitle()
 * @method \Imdb\Entities\Episode getTitleType()
 * @method \Imdb\Entities\Episode getYear()
 * @method \Imdb\Entities\Episode getSeason()
 * @method \Imdb\Entities\Episode getParentTitle()
 */
class Episode extends CultureItem {

    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }

}
