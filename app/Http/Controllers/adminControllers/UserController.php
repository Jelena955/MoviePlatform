<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Request\RegisterRequest;
use App\Mail\DeleteProfileMail;
use App\Mail\MessageMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index ()
    {
        $this->data['users'] = User::with ('role')->get ();
        $this->data['roles'] = Role::all ();
        return view ('pages.admin.tables-user', $this->data);
    }

    public function create ()
    {
        $data = [];
        return view ('pages.admin.insert-user', $this->data);
    }

    public function store (RegisterRequest $request)
    {
        $validated = $request->validated ();
        $validated['password'] = Hash::make ($validated['password']);
        $validated['role_id'] = '1';
        $user = User::create ($validated);
        Auth::login ($user);
        return redirect ("/profile")->with ('success', "Your account has been successfully created!");
    }

    public function update (Request $request)
    {
        try {
            \DB::beginTransaction ();
            $user = User::find ($request->iduser);
            $user->role_id = $request->idrole;
            $user->save ();
            $this->data['roles'] = Role::all ();
            $this->data['msg'] = 'Succesfully change';
            $this->data['users'] = User::with ('role')->find ($request->iduser);
            \DB::commit ();
            echo json_encode ($this->data);

        } catch (\Exception $e) {
            \DB::rollBack ();
            $msg = 'Something went wrong, try again';
            echo json_encode ($msg);
        }
    }

    public function destroy (User $user)
    {
        try {
            \DB::beginTransaction ();
            $user->tag ()->detach ();
            $user->rating ()->detach ();
            $user->delete ();
            \DB::commit ();
            $details = [
                'title' => 'Message from movie-platform@gmail.com',
                'date' => date ('m/d/Y'),
                'body' => 'Your profile has been deleted from Movie Platform ',
            ];
            Mail::to ($user->email)->send (new DeleteProfileMail($details));
            return redirect ('/adminUser')->with ('status', 'Successfully deleted user');
        } catch (Exception $e) {
            \DB::rollBack ();

        }
    }
}
