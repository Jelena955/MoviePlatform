<?php

namespace App\Http\Controllers;

use App\Http\Request\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index ()
    {
        $this->data['user'] = User::getCurrentUser ();
        return view ('pages.profile', $this->data);
    }

    public function create ()
    {
        $this->data['user'] = User::getCurrentUser ();
        return view ('pages.edit-profile', $this->data);
    }

    public function update (UserRequest $request)
    {

        if (Hash::check ($request->password, \auth ()->user ()->password)) {
            $user = User::getCurrentUser ();
            try {
                \DB::beginTransaction ();
                $user->email = $request->email;
                $user->name = $request->name;
                if ($request->newPassword != null) {
                    $user->password = Hash::make ($request->newPassword);
                }
                if ($request->image != null) {
                    if (File::exists (('assets/images/' . $user->img))) {
                        File::delete ('assets/images/' . $user->img);
                    }
                    $imageName = $request->image->getClientOriginalName ();
                    $originalName = explode ('.', $imageName);
                    $uploadName = $originalName[0] . time () . '.' . $originalName[1];
                    $user->img = $uploadName;
                    $request->image->move (public_path ('assets/images/'), $uploadName);
                }
                $user->save ();
                \DB::commit ();
                return redirect ('/profile')->with ('status', 'Profile edited');
            } catch (\Exception $ex) {
                \DB::rollBack ();
                return redirect ('/editProfileForm')->with ('error', 'Something went wrong, try again');
            }
        } else {
            return redirect ("/editProfileForm")->with ('error', 'Password is invalid');
        }
    }
}
