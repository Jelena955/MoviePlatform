<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{


    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "email" => "required|email|unique:users",
            "name" => "required|min:4|max:20",
            "password" => 'required|confirmed|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            "password_confirmation" => 'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            "gender" => 'required'

        ];
    }


}
