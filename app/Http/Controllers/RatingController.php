<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Request\RatingRequest;

class RatingController extends Controller
{
    public function store (RatingRequest $request)
    {
        $ratingModel = new Rating;
        if ($request->validated ()) {
            $rating = floatval ($request->rating);
            $movie_id = $request->idmovie;
            $user_id = auth ()->user ()->id;
            $userRating = $ratingModel->getUsersRating ($movie_id, $user_id);
            if ($userRating) {
                $userRating->rating = $request->rating;
                $id = $userRating->id;
                $userRating->save ();
                $data['message'] = "Rating added successfully";
                $data['rating'] = $rating;
                $data['id'] = $id;
                echo json_encode ($data);
            } else {
                $id = Rating::create (["user_id" => $user_id, "movie_id" => $movie_id, "rating" => $rating])->id;
                $data['message'] = "Rating added successfully";
                $data['rating'] = $rating;
                $data['id'] = $id;
                echo json_encode ($data);
            }
        }
    }

    public function destroy ($id)
    {
        $model=new Rating();
        try{
            $model->deleteRating ($id);
            $data['message'] = "Your rating was deleted successfully";
            echo json_encode ($data);
        }
        catch (\Exception $e){
            $data['message'] = "Something went wrong, try again";
            echo json_encode ($data);
        }




    }
}
