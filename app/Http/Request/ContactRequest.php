<?php

namespace App\Http\Request;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            "message" => "required|min:10"
        ];

    }
}
