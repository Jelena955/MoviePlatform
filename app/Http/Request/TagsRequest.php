<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class TagsRequest extends FormRequest
{


    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "tags" => "array|required"
        ];
    }


}
