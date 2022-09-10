<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{


    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "rating" => "required|numeric|min:0.5|max:5"
        ];
    }


}
