<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Request\TagRequest;
use App\Models\MovieTag;

class TagController extends Controller
{
    public function index ()
    {
        $this->data['tags'] = Tag::all ();

        return view ('pages.admin.tables-tag', $this->data);
    }

    public function create ()
    {
//    dd ($this->data['year']+1);
        return view ('pages.admin.insert-tag', $this->data);
    }

    public function store (TagRequest $request)
    {

        $this->data['tag'] = $request->name;
        try {
            \DB::beginTransaction ();
            $tag = Tag::create ($this->data);
            \DB::commit ();
            return redirect ('/insertTagForm')->with ('status', 'Successfully added tag');
        } catch (\Exception $e) {
            \DB::rollBack ();

        }
    }

    public function destroy ($id)
    {
        try {
            \DB::beginTransaction ();
            $tag = Tag::find ($id)->tag;
            Tag::destroy ($id);
            MovieTag::where ('tag', $tag)->delete ();
            \DB::commit ();
            return redirect ('/adminTags')->with ('status', 'Successfully deleted tag');
        } catch (Exception $e) {
            return redirect ('/adminTags')->with ('error', 'Something went wrong, try again');
            \DB::rollBack ();
        }
    }
}
