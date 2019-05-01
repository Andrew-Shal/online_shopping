<?php

use App\Product;
use App\User;
use App\Rating;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        //
        'user_id' => User::inRandomOrder()->first()->id, //User::inRandomOrder()->first()->id,
        'product_id' => Product::inRandomOrder()->first()->id,
        'rating' => $faker->numberBetween($min = 1, $max = 5),
        'review' => $faker->sentence
    ];
});
