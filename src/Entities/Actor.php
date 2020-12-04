<?php

namespace Imdb\Entities;

use Imdb\Fetcher\BaseFetcher;

/**
 * Class Actor
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\Actor getId()
 * @method \Imdb\Entities\Actor getAkas()
 * @method \Imdb\Entities\Actor getImage()
 * @method \Imdb\Entities\Actor getName()
 * @method \Imdb\Entities\Actor getBirthDate()
 * @method \Imdb\Entities\Actor getBirthPlace()
 * @method \Imdb\Entities\Actor getGender()
 * @method \Imdb\Entities\Actor getHeightCentimeters()
 * @method \Imdb\Entities\Actor getNicknames()
 * @method \Imdb\Entities\Actor getRealName()
 * @method \Imdb\Entities\Actor getSpouses()
 * @method \Imdb\Entities\Actor getTrademarks()
 * @method \Imdb\Entities\Actor getMiniBios()
 * @method \Imdb\Entities\Actor getInterestingJobs(array $options = [])
 * @method \Imdb\Entities\Actor getAllImages(array $options = [])
 * @method \Imdb\Entities\Actor getAllNews(array $options = [])
 * @method \Imdb\Entities\Actor getAwards(array $options = [])
 * @method \Imdb\Entities\Actor getKnownFor(array $options = [])
 * @method \Imdb\Entities\Actor getAllFilmography(array $options = [])
 * @method \Imdb\Entities\Actor getAllVideos(array $options = [])
 * @method \Imdb\Entities\Actor getAwardsSummary(array $options = [])
 * @method static \Imdb\Entities\Actor listMostPopularCelebs(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\Actor listBornToday(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
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

        $options = $arguments ? reset($arguments) : [];

        return $this->fetcher->fetch($endpoint, $this->getOptions($options));
    }

    public static function __callStatic($name, $arguments)
    {
        $endpoint = '/actors/' . preg_replace_callback('/[A-Z]/', function ($matches) {
                return '-' . strtolower($matches[0]);
            }, $name);

        list($fetcher, $options) = $arguments;

        return $fetcher->fetch($endpoint, $options);
    }

    public function getOptions($options) {
        return [self::ID_OPTION => $this->getPureId()] + $options;
    }
}
