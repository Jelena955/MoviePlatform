<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogedUser extends Model
{
    protected $table = 'loged_user';

    protected $fillable = [
        'ip',
        'email',
        'url',
        'method'
    ];
}
