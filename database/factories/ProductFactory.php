<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'current_price' => $faker->numberBetween($min = 10, $max = 500),
        'qty' => $faker->numberBetween($min = 1, $max = 100),
        'featured_photo' => 'noimage_placeholder.jpg',
        'description' => $faker->sentence,
        'condition' => $faker->word,
        'return_policy' => $faker->word,
        'total_views' => 0,
        'user_id' => 1,
        'is_active' => 1,
        'ecat_id' => 1
    ];
});
