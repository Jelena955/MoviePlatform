<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{


    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "email" => "required|email",
            "name" => "required|min:4|max:20",
            "password" => 'required|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            "newPassword" => 'nullable|min:8|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            "image" => "nullable|image"
        ];
    }


}
