<?php


namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Request\GenreRequest;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index ()
    {
        $this->data['genres'] = Genre::all ();
        return view ('pages.admin.tables-genre', $this->data);
    }

    public function create ()
    {
        return view ('pages.admin.insert-genre', $this->data);
    }

    public function edit ($id)
    {
        $this->data['genre'] = Genre::find ($id);
        return view ('pages.admin.edit-genre', $this->data);
    }

    public function update (Request $request, $id)
    {
        try {
            \DB::beginTransaction ();
            $genre = Genre::find ($id);
            $genre->name = $request->name;
            $genre->save ();
            \DB::commit ();
            return redirect ('/adminGenre')->with ('status', 'Successfully edited genre');
        } catch (\Exception $e) {
            \DB::rollback ();
            return redirect ('/adminGenre')->with ('error', 'Something went wrong, try genre');

        }
    }

    public function store (GenreRequest $request)
    {

        $this->data['name'] = $request->name;
        try {
            \DB::beginTransaction ();
            Genre::create (["name" => $request->name]);
            \DB::commit ();
            return redirect ('/insertGenreForm')->with ('status', 'Successfully added genre');
        } catch (\Exception $e) {
            \DB::rollBack ();
            return redirect ('/insertGenreForm')->with ('error', 'Something went wrong, try again');

        }
    }

    public function destroy (Genre $genre)
    {
        try {
            \DB::beginTransaction ();
            $genre->delete ();
            \DB::commit ();
            return redirect ('/adminGenre')->with ('status', 'Successfully deleted genre');
        } catch (Exception $e) {
            return redirect ('/adminGenre')->with ('error', 'Something went wrong, try again');
            \DB::rollBack ();

        }
    }
}


