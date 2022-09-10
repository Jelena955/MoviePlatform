<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run ()
    {
        $genres=['Action', 'Romance', 'Sci-Fi', 'Comedy', 'Children', 'Thriller', 'Drama',
        'Mystery', 'Horror', 'War', 'Fantasy', 'Crime', 'Documentary', 'Musical'];
        foreach ($genres as $genre) {
            DB::table ('genres')->insert ([
                'name' => $genre
            ]);
        }
    }
}
