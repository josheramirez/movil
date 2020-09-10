<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'description'=>$faker->sentence($nbWords = 16, $variableNbWords = true),
        'user_id'=>Auth::user()->id
    ];
});
