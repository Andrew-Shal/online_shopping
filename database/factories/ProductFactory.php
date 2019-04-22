<?php

use App\User;
use Faker\Generator as Faker;
use Bezhanov\Faker\Provider\Commerce as EFaker;

$factory->define(App\Product::class, function (Faker $faker) {
    $e_faker = \Faker\Factory::create();
    $e_faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($e_faker));

    $p_name = $e_faker->productName;

    $arr = explode(' ', $p_name);
    $slug = sizeof($arr) < 1 ? implode('', $arr) : implode('-', $arr);


    return [
        'name' => $p_name,
        'current_price' => $faker->numberBetween($min = 10, $max = 500),
        'qty' => $faker->numberBetween($min = 1, $max = 100),
        'featured_photo' => 'noimage_placeholder.jpg',
        'description' => $faker->sentence,
        'condition' => $faker->word,
        'return_policy' => $faker->word,
        'total_views' => 0,
        //'user_id' => User::inRandomOrder()->first()->id,
        'slug' => $slug,
        'is_active' => 1,
        'ecat_id' => 1,
    ];
});
