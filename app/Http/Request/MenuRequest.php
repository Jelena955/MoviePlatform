<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{


    public function authorize ()
    {
        return true;
    }

    public function rules ()
    {
        return [
            "menu_title" => "required|min:4|unique:menu",
            "link" => "required|min:4|unique:menu"
        ];
    }


}
