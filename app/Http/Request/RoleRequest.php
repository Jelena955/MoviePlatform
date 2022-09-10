<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{


    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "role" => "required|min:2|unique:roles",
        ];
    }


}
