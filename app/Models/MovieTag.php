<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieTag extends Model
{
    use HasFactory;

    protected $table = 'movies_tags';
    protected $fillable = [
        'tag',
        'user_id',
        'movie_id'

    ];

    public function getTagsForSearch ($id, $search)
    {
        if ($search != "") {
            $search = addslashes ($search);
//            $this->where("movie_id", $id)->where("tag", "LIKE", "$search%")->groupBy("tag")->get();
            return $this->select ("tag", "id")->where ("movie_id", $id)->where ("tag", "LIKE", "$search%")->groupBy ("tag")->get ();
        } else {
            return $this->select ("tag", "id")->where ("movie_id", $id)->groupBy ("tag")->get ();

        }
    }

    //proverava da li je korisnik vec dao taj tag za ovaj film
    public function checkExistingTags ($idMovie, $idUser, $tag)
    {
        $tag = addslashes ($tag);
        $model = new MovieTag();
        return $model->select ("movies_tags.tag")
            ->where ('movie_id', $idMovie)
            ->where ('user_id', $idUser)
            ->where ('tag', $tag)
            ->get ();
    }

    //izracunavanje scores za tagove u odnosu na to koliki je ukupnan br tagova i koliko odredjenog taga
    public function calculatingScore ($idMovie, $tag)
    {
        $numberOfAllTags = $this->where ('movie_id', $idMovie)->count ('tag');
        $numberOfSpecificTag = $this->where ([['movie_id', $idMovie], ["tag", $tag]])->count ("tag");
        return $numberOfSpecificTag / $numberOfAllTags;
    }
}
