<?php

namespace App\Http\Controllers;

use App\Models\MovieTag;
use App\Models\Score;
use App\Models\Tag;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class MovieTagController extends Controller
{

    public function show ($id)
    {
        if (isset($_GET['term'])) {
            $search = $_GET['term'];
            $modelMovieTag = new MovieTag();
            $tags = $modelMovieTag->getTagsForSearch ($id, $search);
        } else {
            $search = "";
            $modelMovieTag = new MovieTag();
            $tags = $modelMovieTag->getTagsForSearch ($id, $search);

        }
        return json_encode ($tags);

    }

    public function addTags (Request $request)
    {
        //ako je kliknuto na dugme, a nista nije upisano ne radi se nikakvo dodavanje,
        // vec se korisniku vraca informacija da mora da upise nesto
        try {

            if (!empty($request->tags)) {
                $tags[] = $request->tags;
                $idMovie = $request->idmovie;
                $idUser = auth ()->user ()->id;
                $modelMovieTag = new MovieTag();
                $modelTag = new Tag();
                $modelScore = new Score();
                foreach ($tags[0] as $tag) {
                    // posto je tag unique u bazi, ukoliko tag uopste ne postoji dodaje ga
                    if (count ($modelTag->findByName ($tag)) == 0) {
                        Tag::create (["tag" => $tag]);
                    }
//                       // za svaki tag se proverava da li ga je korisnik vec ubacio za ovaj film i ako nije ubacuje se
                    if (count ($modelMovieTag->checkExistingTags ($idMovie, $idUser, $tag)) == 0) {
                        $tagScore = MovieTag::create (["tag" => $tag,
                            "user_id" => $idUser,
                            "movie_id" => $idMovie])->tag;
                        //posle ubacenog taga se updatuje relevance ako postoji skor, ako ne kreira se
                        $relevance = $this->calculate ($idMovie, $tag);
                        if (count ($modelScore->findByMovieAndTag ($idMovie, $tagScore)) == 0) {
                            $data["tag"] = $tag;
                            $data["movie_id"] = $idMovie;
                            $data["relevance"] = $relevance;
                            Score::create ($data);

                        } else {
                            $idScore = $modelScore->findByMovieAndTag ($idMovie, $tagScore)[0]->id;
                            $score = Score::find ($idScore);
                            $score->relevance = $relevance;
                            $score->save ();
                        }
                    }
                }
                $message = "You added tags successfully";
                echo json_encode ($message);
                http_response_code (201);
            } else {
                $message = "You must add tags";
                echo json_encode ($message);
            }
        } catch
        (\Exception $ex) {
            $message = $ex->getMessage ();
            echo json_encode ($message);
            http_response_code (500);
        }


    }

    public function calculate ($idmovie, $tag)
    {
        $model = new MovieTag();
        return $model->calculatingScore ($idmovie, $tag);
    }

}
