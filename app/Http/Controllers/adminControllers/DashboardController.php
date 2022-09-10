<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Models\LogedUser;
use App\Models\LoggedOutUser;
use App\Models\Message;
use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;

class DashboardController extends Controller
{
    public function index ()
    {
        $this->data['numberOfUsers'] = User::count ();
        $countDate = date ('Y-m-d h:i:s', strtotime ("-20 day"));
        $this->data['newestUsers'] = User::where ('created_at', ">", $countDate)->get ();
        $this->data['numberOfUsersNewest'] = $this->data['newestUsers']->count ();
        $this->data['numberOfMovies'] = Movie::count ();
        $this->data['numberOfRatings'] = Rating::count ();
        $this->data['messages'] = Message::all ();
        $this->data['mostPopularMovie'] = Movie::withCount ('tag')->orderBy ('tag_count', 'DESC')->get ();
        $this->data['loggedUsers'] = LogedUser::orderBy ('created_at', 'DESC')->get ();
        $this->data['loggedOutUsers'] = LoggedOutUser::orderBy ('created_at', 'DESC')->get ();
        //najpopularniji film po broju datih tagova
        return view ("pages.admin.dashboard", $this->data);
    }

    public function filterR ($model, $request, $variable)
    {
        if ($request->date != "") {
            $date = new DateTime($request->date);
            $afterday = $date->modify ('+1 day');
            $this->data[$variable] = $model::where ('created_at', ">=", $request->date)->where ('created_at', "<", $afterday)->get ();
        } else {
            $countDate = date ('Y-m-d h:i:s', strtotime ("-20 day"));
            $this->data[$variable] = $model::where ('created_at', ">", $countDate)->get ();
        }
        return json_encode ($this->data[$variable]);

    }

    public function filterRegister (Request $request)
    {
        return $this->filterR (new User(), $request, 'newestUser');
    }

    public function filterLogins (Request $request)
    {
        return $this->filterR (new LogedUser(), $request, 'loggedUsers');

    }

    public function filterLogouts (Request $request)
    {
        return $this->filterR (new LoggedOutUser(), $request, 'loggedOutUsers');
    }

    public function destroyMessage (Message $message)
    {
        try {
            \DB::beginTransaction ();
            $message->delete ();
            \DB::commit ();
            return redirect ('/adminPanel')->with ('status', 'Successfully deleted message');
        } catch (Exception $e) {
            return redirect ('/adminPanel')->with ('error', 'Something wen wrong, try again');
            \DB::rollBack ();

        }
    }
}
