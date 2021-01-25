<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class Episode
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\VideoGame getId($expired = NULL)
 * @method \Imdb\Entities\VideoGame getImage($expired = NULL)
 * @method \Imdb\Entities\VideoGame getTitle($expired = NULL)
 * @method \Imdb\Entities\VideoGame getTitleType($expired = NULL)
 * @method \Imdb\Entities\VideoGame getYear($expired = NULL)
 */
class VideoGame extends CultureItem
{
    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }
}
