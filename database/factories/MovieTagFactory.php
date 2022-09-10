<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Movie;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Role;

class MovieTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'movie_id'=>Movie::all ()->random ()->id,
            'user_id'=>User::all ()->random ()->id,
            'tag'=>Tag::all ()->random ()->tag

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
