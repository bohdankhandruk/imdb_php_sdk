<?php

namespace Imdb\Entities;

/**
 * Class CultureItem
 * @package Imdb\Entities
 *
 * @method \Imdb\Entities\CultureItem getReleases(array $options = [])
 * @method \Imdb\Entities\CultureItem getMetaData(array $options = [])
 * @method \Imdb\Entities\CultureItem getFilmingLocations(array $options = [])
 * @method \Imdb\Entities\CultureItem getAllImages(array $options = [])
 * @method \Imdb\Entities\CultureItem getImages(array $options = [])
 * @method \Imdb\Entities\CultureItem getVideos(array $options = [])
 * @method \Imdb\Entities\CultureItem getMoreLikeThis(array $options = [])
 * @method \Imdb\Entities\CultureItem getCharnameList(array $options = [])
 * @method \Imdb\Entities\CultureItem getGenres(array $options = [])
 * @method \Imdb\Entities\CultureItem getSynopses(array $options = [])
 * @method \Imdb\Entities\CultureItem getReviews(array $options = [])
 * @method \Imdb\Entities\CultureItem getNews(array $options = [])
 * @method \Imdb\Entities\CultureItem getReleaseExpectationBundle(array $options = [])
 * @method \Imdb\Entities\CultureItem getProductionStatus(array $options = [])
 * @method \Imdb\Entities\CultureItem getSeasons(array $options = [])
 * @method \Imdb\Entities\CultureItem getBase(array $options = [])
 * @method \Imdb\Entities\CultureItem getHeroWithPromotedVideo(array $options = [])
 * @method \Imdb\Entities\CultureItem getAwardsSummary(array $options = [])
 * @method \Imdb\Entities\CultureItem getUserReviews(array $options = [])
 * @method \Imdb\Entities\CultureItem getMetacritic(array $options = [])
 * @method \Imdb\Entities\CultureItem getAwards(array $options = [])
 * @method \Imdb\Entities\CultureItem getRating(array $options = [])
 * @method \Imdb\Entities\CultureItem getTopCrew(array $options = [])
 * @method \Imdb\Entities\CultureItem getTechnical(array $options = [])
 * @method \Imdb\Entities\CultureItem getParentalGuide(array $options = [])
 * @method \Imdb\Entities\CultureItem getPlots(array $options = [])
 * @method \Imdb\Entities\CultureItem getTaglines(array $options = [])
 * @method \Imdb\Entities\CultureItem getVersions(array $options = [])
 * @method \Imdb\Entities\CultureItem getOverviewDetails(array $options = [])
 * @method \Imdb\Entities\CultureItem getTopCast(array $options = [])
 * @method \Imdb\Entities\CultureItem getTopStripe(array $options = [])
 * @method static \Imdb\Entities\CultureItem getTopRatedTvShows(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem getBestPictureWinners(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem getMostPopularTvShows(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem listPopularGenres(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem getTopRatedMovies(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem getComingSoonMovies(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem getComingSoonTvShows(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem getMostPopularMovies(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem getPopularMoviesByGenre(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 * @method static \Imdb\Entities\CultureItem getVideoPlayback(\Imdb\Fetcher\AbstractFetcher $fetcher, array $options = [])
 */
abstract class CultureItem extends ImdbItem
{
    const BASE_ENDPOINT = '/title/get-details';
    const ID_OPTION = 'tconst';

    public function __toString() {
        return $this->getTitle();
    }

    public function __call($name, $arguments)
    {
        $result = parent::__call($name, $arguments);

        if (isset($result)) {
            return $result;
        }

        $endpoint = '/title/' . preg_replace_callback('/[A-Z]/', function ($matches) {
                return '-' . strtolower($matches[0]);
            }, $name);

        $options = $arguments ? reset($arguments) : [];

        return $this->fetcher->fetch($endpoint, $this->getOptions($options));
    }

    public static function __callStatic($name, $arguments)
    {
        $endpoint = '/title/' . preg_replace_callback('/[A-Z]/', function ($matches) {
                return '-' . strtolower($matches[0]);
            }, $name);

        $fetcher = $arguments[0];
        $options = $arguments[1] ?? [];

        return $fetcher->fetch($endpoint, $options);
    }

    public function getOptions($options) {
        return [self::ID_OPTION => $this->getPureId()] + $options;
    }
}
