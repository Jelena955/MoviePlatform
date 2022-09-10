<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;

    protected $table = 'scores';
    protected $fillable = [
        "tag",
        "movie_id",
        "relevance"
    ];

    public function findByMovieAndTag ($idMovie, $tag)
    {
        return $this->where ('movie_id', $idMovie)->where ('tag', $tag)->get ();
    }
}
