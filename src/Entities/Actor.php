<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class Actor
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\Actor getId($expired = NULL)
 * @method \Imdb\Entities\Actor getAkas($expired = NULL)
 * @method \Imdb\Entities\Actor getImage($expired = NULL)
 * @method \Imdb\Entities\Actor getName($expired = NULL)
 * @method \Imdb\Entities\Actor getBirthDate($expired = NULL)
 * @method \Imdb\Entities\Actor getBirthPlace($expired = NULL)
 * @method \Imdb\Entities\Actor getGender($expired = NULL)
 * @method \Imdb\Entities\Actor getHeightCentimeters($expired = NULL)
 * @method \Imdb\Entities\Actor getNicknames($expired = NULL)
 * @method \Imdb\Entities\Actor getRealName($expired = NULL)
 * @method \Imdb\Entities\Actor getSpouses($expired = NULL)
 * @method \Imdb\Entities\Actor getTrademarks($expired = NULL)
 * @method \Imdb\Entities\Actor getMiniBios($expired = NULL)
 * @method \Imdb\Entities\Actor getInterestingJobs(array $options = [], $expired = NULL)
 * @method \Imdb\Entities\Actor getAllImages(array $options = [], $expired = NULL)
 * @method \Imdb\Entities\Actor getAllNews(array $options = [], $expired = NULL)
 * @method \Imdb\Entities\Actor getAwards(array $options = [], $expired = NULL)
 * @method \Imdb\Entities\Actor getKnownFor(array $options = [], $expired = NULL)
 * @method \Imdb\Entities\Actor getAllFilmography(array $options = [], $expired = NULL)
 * @method \Imdb\Entities\Actor getAllVideos(array $options = [], $expired = NULL)
 * @method \Imdb\Entities\Actor getAwardsSummary(array $options = [], $expired = NULL)
 * @method static \Imdb\Entities\Actor listMostPopularCelebs(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [], $expired = NULL)
 * @method static \Imdb\Entities\Actor listBornToday(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [], $expired = NULL)
 */
class Actor extends ImdbItem
{
    const BASE_ENDPOINT = '/actors/get-bio';
    const ID_OPTION = 'nconst';

    public function __construct(BaseFetcher $fetcher, $name)
    {
        parent::__construct($fetcher);

        $this->retrieveData($name, self::BASE_ENDPOINT, self::ID_OPTION);
    }

    public function __toString() {
        return $this->getName();
    }

    public function __call($name, $arguments)
    {
        $result = parent::__call($name, $arguments);

        if (isset($result)) {
            return $result;
        }

        $endpoint = '/actors/' . preg_replace_callback('/[A-Z]/', function ($matches) {
            return '-' . strtolower($matches[0]);
        }, $name);

        $options = [];
        switch (count($arguments)) {
          case 1:
            $expired = reset($arguments);
            break;
          case 2:
            $options = reset($arguments);
            $expired = $arguments[1];
            break;
          default:
            $expired = NULL;
        }

        return $this->fetcher->fetch($endpoint, $this->getOptions($options), $expired);
    }

    public static function __callStatic($name, $arguments)
    {
        $endpoint = '/actors/' . preg_replace_callback('/[A-Z]/', function ($matches) {
                return '-' . strtolower($matches[0]);
            }, $name);

        list($fetcher, $options, $expired) = $arguments;

        return $fetcher->fetch($endpoint, $options, $expired);
    }

    public function getOptions($options) {
        return [self::ID_OPTION => $this->getPureId()] + $options;
    }
}
