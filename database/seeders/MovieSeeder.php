<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;



class MovieSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles=['Matrix', 'Don\'t look up', 'Spiderman', 'Tou Story', 'Inception','Shutter Island',
            'Fight Club','La Casa De Papel'];
        $faker= Faker::create();
        foreach ($titles as $title) {
            DB::table ('movies')->insert ([
                'title' => $title,
                'year' => $faker->year

            ]);
                }
    }
}
