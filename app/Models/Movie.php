<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $fillable = ["title", "year", "img"];

    public function ratings ()
    {
        return $this->hasMany (Rating::class);
    }

    public function tag ()
    {
        return $this->hasMany (MovieTag::class);
    }

    public function tags ()
    {
        return $this->belongsToMany (Tag::class, 'movies_tags', 'tag', 'tag');
    }

    public function genre ()
    {
        return $this->belongsToMany (Genre::class);
    }

    public function getMoviesWithRating ()
    {
        return Movie::withAvg ('ratings', 'rating')->paginate (8);
    }

    public function getMoviesFromSearch ($movieSearch = null)
    {


        if ($movieSearch != null) {


            $movieSearch = strtolower ($movieSearch);
            return $this
                ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                ->where ('movies.title', 'Like', "%$movieSearch%")
                ->groupBy ('movies.title')
                ->paginate (8);
        } else {
            return $this
                ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                ->groupBy ('movies.title')
                ->paginate (8);

        }
    }

    public function getMoviesFromSearchAndFilter ($movieSearch = null, $filterMovie = null, $sortMovies = null)
    {

        $movieSearch = strtolower ($movieSearch);
        if ($movieSearch != null) {
            if ($filterMovie != null && $filterMovie != 'all') {
                if ($sortMovies != null && $sortMovies != 'def') {
                    if ($sortMovies == 'old')
                        return $this
                            ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                            ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                            ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                            ->where ('movies.title', 'Like', "%$movieSearch%")->where ('genres.id', $filterMovie)
                            ->groupBy ('movies.title')
                            ->orderBy ('year')
                            ->paginate (8);
                    else if ($sortMovies == 'lat') {
                        return $this
                            ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                            ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                            ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                            ->where ('movies.title', 'Like', "%$movieSearch%")->where ('genres.id', $filterMovie)
                            ->groupBy ('movies.title')
                            ->orderBy ('year', 'DESC')
                            ->paginate (8);
                    }
                } else {
                    return $this
                        ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                        ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                        ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                        ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                        ->where ('movies.title', 'Like', "%$movieSearch%")->where ('genres.id', $filterMovie)
                        ->groupBy ('movies.title')
                        ->paginate (8);
                }
            } else {
                if ($sortMovies != null && $sortMovies != 'def') {
                    if ($sortMovies == 'old') {


                        return $this
                            ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                            ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                            ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                            ->where ('movies.title', 'Like', "%$movieSearch%")
                            ->groupBy ('movies.title')
                            ->orderBy ('year')
                            ->paginate (8);

                    } else if ($sortMovies == 'lat') {


                        return $this
                            ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                            ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                            ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                            ->where ('movies.title', 'Like', "%$movieSearch%")
                            ->groupBy ('movies.title')
                            ->orderBy ('year', 'DESC')
                            ->paginate (8);

                    }
                } else {
                    return $this
                        ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                        ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                        ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                        ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                        ->where ('movies.title', 'Like', "%$movieSearch%")
                        ->groupBy ('movies.title')
                        ->paginate (8);
                }
            }
        } else {
            if ($filterMovie != null && $filterMovie != 'all') {
                if ($sortMovies != null && $sortMovies != 'def') {
                    if ($sortMovies == 'old')
                        return $this
                            ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                            ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                            ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                            ->where ('movies.title', 'Like', "%$movieSearch%")->where ('genres.id', $filterMovie)
                            ->groupBy ('movies.title')
                            ->orderBy ('year')
                            ->paginate (8);
                    else if ($sortMovies == 'lat') {
                        return $this
                            ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                            ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                            ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                            ->where ('movies.title', 'Like', "%$movieSearch%")->where ('genres.id', $filterMovie)
                            ->groupBy ('movies.title')
                            ->orderBy ('year', 'DESC')
                            ->paginate (8);
                    }
                } else {
                    return $this
                        ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                        ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                        ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                        ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                        ->where ('movies.title', 'Like', "%$movieSearch%")->where ('genres.id', $filterMovie)
                        ->groupBy ('movies.title')
                        ->paginate (8);
                }
            } else {
                if ($sortMovies != null && $sortMovies != 'def') {
                    if ($sortMovies == 'old')
                        return $this
                            ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                            ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                            ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                            ->where ('movies.title', 'Like', "%$movieSearch%")
                            ->groupBy ('movies.title')
                            ->orderBy ('year')
                            ->paginate (8);
                    else if ($sortMovies == 'lat') {
                        return $this
                            ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                            ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                            ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                            ->where ('movies.title', 'Like', "%$movieSearch%")
                            ->groupBy ('movies.title')
                            ->orderBy ('year', 'DESC ')
                            ->paginate (8);
                    }
                } else {
                    return $this
                        ->Join ('ratings', 'ratings.movie_id', '=', 'movies.id')
                        ->join ('genre_movie', 'movies.id', '=', 'genre_movie.movie_id')
                        ->join ('genres', 'genres.id', '=', 'genre_movie.genre_id')
                        ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
                        ->where ('movies.title', 'Like', "%$movieSearch%")
                        ->groupBy ('movies.title')
                        ->paginate (8);
                }
            }
        }
    }


    public function getBestRatedMovies ()
    {
        return $this
            ->join ('ratings', 'ratings.movie_id', '=', 'movies.id')
            ->select ('movies.id', 'movies.year', 'movies.title', 'movies.img', DB::raw ('AVG(ratings.rating) AS ratings_avg_rating'))
            ->groupBy ('movie_id')
            ->orderBy ('ratings_avg_rating', 'DESC')
            ->limit (4)
            ->get ();
    }
}
