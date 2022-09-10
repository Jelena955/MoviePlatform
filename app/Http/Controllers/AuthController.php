<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function setPassword ($password)
    {
        return Hash::make ($password);
    }
}
