<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersid=User::all ();
        $min = 1;
        $max = 5;

        for ($i=0; $i<count($usersid)-50;$i++){
            DB::table ('ratings')->insert ([
                'rating' => mt_rand($min * 2, $max * 2) / 2,
                'user_id' => $usersid[$i]->id,
                'movie_id'=>Movie::all ()->random ()->id

            ]);

        }
    }
}
