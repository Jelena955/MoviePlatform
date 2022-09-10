<?php

namespace App\Http\Controllers;

use App\Http\Request\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisterController extends AuthController
{

    public function create ()
    {
        return view ('pages.register', $this->data);
    }

    public function store (RegisterRequest $request)
    {
        $validated = $request->validated ();
        $validated['password'] = Hash::make ($validated['password']);
        $validated['role_id'] = '1';
        try {
            $user = User::create ($validated);
            Auth::login ($user);
            return redirect ("/profile")->with ('status', "Your account has been successfully created!");
        } catch (\Exception $e) {
            return redirect ("/registerForm")->with ('error', "Something went wrong, try again");
        }
    }
}
