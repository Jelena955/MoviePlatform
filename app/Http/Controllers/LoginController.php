<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Models\LogedUser;
use App\Models\LoggedOutUser;
use App\Models\User;
use Composer\DependencyResolver\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\ValidationException;
use Illuminate\Http\Request as Requested;

class LoginController extends AuthController
{
    public function index ()
    {
        return view ('pages.login', $this->data);

    }

    public function login (LoginRequest $request)
    {
        $validation = $request->validated ();
        if (Auth::attempt ($validation)) {
            $this->log ($request, new LogedUser());

            return redirect ('/profile');

        } else {
            return redirect ('/loginForm')->with ('error', 'Wrong email or password');
        }
    }

    public function destroy (Requested $request)
    {
        $this->log ($request, new LoggedOutUser());
        Auth::logout ();

        return redirect ('/home')->with ('status', 'Goodbye');
        // return redirect('/login');
    }

    public function log ($request, $table)
    {
        $data = [];
        $data['ip'] = $request->ip ();
        $data['url'] = $request->url ();
        $data['method'] = $request->method ();
        $data['email'] = \auth ()->user ()->email;
        $table::create ($data);

    }
}
