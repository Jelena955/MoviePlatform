<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieGenre;
use App\Models\Genre;

use App\Models\MovieTag;
use App\Models\Rating;
use Illuminate\Http\Request;


class MovieController extends Controller
{
    protected $movieModel;

    public function index ($movieSearch = null)
    {

        $movie = new Movie();

        if ($movieSearch != null) {
            $data = $movieSearch;
            $this->data['movies'] = $movie->getMoviesFromSearch (strtolower ($data));
//                return json_encode ($movieSearch);
            return view ('pages.all-movies', $this->data);
        } else {
            $this->movieModel = new Movie();
            $this->data['movies'] = $this->movieModel->getMoviesWithRating ();

        }
        $this->data['genres'] = Genre::all ();


        return view ('pages.all-movies', $this->data);

    }

    public function show ($id)
    {
        $this->data['tags'] = Movie::find ($id)->tag ()->groupBy ('tag')->get ();
        $this->data['genres'] = Movie::find ($id)->genre;
        $this->data['movie'] = Movie::find ($id);
        $this->data['rating'] = Movie::withAvg ('ratings', 'rating')->find ($id);
        if (!empty(auth ()->user ())) {
            $this->data['userRating'] = Rating::where ([['movie_id', $id], ['user_id', auth ()->user ()->id]])->get ();
        }
        return view ('pages.movie-page', $this->data);
    }

    public function searchMovie (Request $request)
    {
        $movie = new Movie();
        $data = $request->moviesSearch;
        $dataFilter = $request->filterMovies;
        $dataSort = $request->sortMovies;
        $movieSearch = $movie->getMoviesFromSearchAndFilter (strtolower ($data), $dataFilter, $dataSort);
        return json_encode ($movieSearch);
    }
}
