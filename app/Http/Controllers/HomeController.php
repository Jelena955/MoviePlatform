<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class HomeController extends Controller
{
    public function index ()
    {
        $movie = new Movie();
        $this->data['moviesPopular'] = Movie::withCount ('tag')->withAvg ('ratings', 'rating')->orderBy ('tag_count', 'DESC')->limit (4)->get ();
        $this->data['moviesBest'] = $movie->getBestRatedMovies ();

        $this->data['moviesLatest'] = Movie::withAvg ('ratings', 'rating')->orderBy ('year', 'DESC')->limit (4)->get ();

        return view ("pages.home", $this->data);
    }
}
