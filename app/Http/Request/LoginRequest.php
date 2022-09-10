<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "email" => "required|email",
            "password" => 'required|min:4'
        ];

    }
}
