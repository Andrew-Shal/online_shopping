<?php

use App\User;
use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'body' => $faker->paragraph,
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'cover_image' => ''
    ];
});
