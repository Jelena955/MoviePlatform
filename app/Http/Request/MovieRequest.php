<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{


    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "title" => "required|min:2|max:200",
            "year" => "required|min:4|max:4",
            "image" => "sometimes|required|image",
            "imageedit" => "sometimes|required|image",
            "genre" => "required",
        ];
    }


}
