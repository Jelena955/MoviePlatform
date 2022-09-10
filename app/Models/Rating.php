<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'ratings';
    protected $fillable = ["movie_id", "user_id", "rating"];

    public function movie ()
    {
        return $this->belongsTo (Movie::class);

    }

    public function getUsersRating ($idMovie, $idUser)
    {
        return Rating::where ([['movie_id', $idMovie], ['user_id', [$idUser]]])->first ();
    }

    function storeRating ($values)
    {
        $this->create (["rating", "movie_id", "user_id", "timestamp", "updated_at"], $values);
    }

    function updateRating ($setcolumns, $wherecolumns, $values)
    {
        $this->updateMore ($setcolumns, $wherecolumns, $values);
    }

    function deleteRating ($id)
    {
        Rating::where('movie_id', $id)->where('user_id', auth ()->user ()->id)->delete();
    }

}
