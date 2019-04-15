<?php

use App\Billing;
use Faker\Generator as Faker;

$factory->define(Billing::class, function (Faker $faker) {
    /*return [
        'billing_email' => $faker->safeEmail,
        'billing_name' => $faker->name,
        'billing_address' => $faker->address,
        'billing_city' => $faker->city,
        'billing_province' => $faker->country,
        'billing_phone' => $faker->phoneNumber,
        'user_id' => 2
    ];*/
    return [
        'billing_email' => 'shalandrew97@gmail.com',
        'billing_name' => 'andrew shal',
        'billing_address' => 'san martin',
        'billing_city' => 'belmopan',
        'billing_province' => 'belize',
        'billing_phone' => 6244690,
        'user_id' => 1
    ];
});
