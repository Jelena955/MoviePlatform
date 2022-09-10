<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
{


    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "name" => "required|min:4",
        ];
    }


}
