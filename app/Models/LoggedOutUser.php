<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoggedOutUser extends Model
{
    protected $table = 'loggedout_user';

    protected $fillable = [
        'ip',
        'email',
        'url',
        'method'
    ];
}
