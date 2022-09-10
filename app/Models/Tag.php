<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
    ];

    public function movies ()
    {
        return $this->belongsToMany (Movie::class, 'movies_tags', 'tag', 'tag');
    }

    public function findByName ($tag)
    {
        $tag = addslashes ($tag);
        return $this->where ("tag", $tag)->get ();
    }
}
