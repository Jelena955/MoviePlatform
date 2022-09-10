<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Movie;
use App\Http\Request\MovieRequest;
use App\Models\MovieGenre;
use App\Models\MovieTag;
use App\Models\Rating;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    public function index ()
    {
        $this->data['movies'] = Movie::with ('tag', 'genre')->get ();

        return view ('pages.admin.tables-movie', $this->data);
    }

    public function create ()
    {
        $this->data['genres'] = Genre::all ();
        $this->data['year'] = date ('Y');
//    dd ($this->data['year']+1);
        return view ('pages.admin.insert-movie', $this->data);
    }

    public function store (MovieRequest $request)
    {
        if ($request->image != null) {
            $imageName = $request->image->getClientOriginalName ();
            $originalName = explode ('.', $imageName);
            $uploadName = $originalName[0] . time () . '.' . $originalName[1];
        } else {
            $uploadName = 'noimage.jpg';
        }
        $this->data['title'] = $request->title;
        $this->data['year'] = $request->year;
        $this->data['img'] = $uploadName;
        try {
            \DB::beginTransaction ();
            $movie = Movie::create ($this->data);
            $id = $movie->id;
            $user = auth ()->user ()->id;
            Rating::create (["user_id" => $user, "movie_id" => $id, "rating" => null]);
            if ($request->image != null) {
                $request->image->move (public_path ('assets/images/'), $uploadName);
            }
            $movie->genre ()->sync ($request->genre);
            \DB::commit ();
            return redirect ('/adminMovies')->with ('status', 'Successfully added movie');
        } catch (Exception $e) {
            return redirect ('/adminMovies')->with ('error', 'Something went wrong, try again');
            \DB::rollBack ();

        }
    }

    public function destroy ($id)
    {
        try {
            \DB::beginTransaction ();
            $movie = Movie::find ($id)->img;
            MovieGenre::where ('movie_id', $id)->delete ();
            MovieTag::where ('movie_id', $id)->delete ();
            Rating::where ('movie_id', $id)->delete ();
            Movie::destroy ($id);
            File::delete ('assets/images/' . $movie);
            \DB::commit ();
            return redirect ('/adminMovies')->with ('status', 'Successfully deleted movie');
        } catch (Exception $e) {
            return redirect ('/adminMovies')->with ('error', 'Something went wrong. try again');
            \DB::rollBack ();

        }
    }

    public function edit ($id)
    {
        $this->data['movie'] = Movie::with ('genre', 'tag')->find ($id);
        $this->data['genres'] = Genre::all ();
        $this->data['year'] = date ('Y');


        return view ('pages.admin.edit-movie', $this->data);
    }

    public function update (MovieRequest $request)
    {
        $movie = Movie::find ($request->idmovie);
        $movie->title = $request->title;
        $movie->year = $request->year;

        if ($request->imageedit != null) {
            $imageName = $request->imageedit->getClientOriginalName ();
            $originalName = explode ('.', $imageName);
            $uploadName = $originalName[0] . time () . '.' . $originalName[1];
            $movie->img = $uploadName;
            $request->imageedit->move (public_path ('assets/images/'), $uploadName);
        }
        $movie->save ();
        try {
            \DB::beginTransaction ();
            $movie->genre ()->sync ($request->genre);
            \DB::commit ();
            return redirect ('/adminMovies')->with ('status', 'Successfully edited movie');
        } catch (Exception $e) {
            \DB::rollBack ();

            return redirect ('/adminMovies')->with ('error', 'Something went wrong, try again');

        }
    }
}
