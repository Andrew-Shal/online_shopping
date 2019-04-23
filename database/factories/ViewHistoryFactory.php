<?php

use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'user_id' => User::inRandomOrder()->first()->id,
        'product_id' => Product::inRandomOrder()->first()->id
    ];
});
