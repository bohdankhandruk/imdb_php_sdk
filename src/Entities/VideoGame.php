<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class Episode
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\VideoGame getId()
 * @method \Imdb\Entities\VideoGame getImage()
 * @method \Imdb\Entities\VideoGame getTitle()
 * @method \Imdb\Entities\VideoGame getTitleType()
 * @method \Imdb\Entities\VideoGame getYear()
 */
class VideoGame extends CultureItem
{
    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }
}
