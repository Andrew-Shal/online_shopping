<?php

use App\User;
use App\Enums\AccountStatus;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/


//use this to seed db with user,products,billing,posts
//enter in tinker and run

/* factory(App\User::class, 100)->create()->each(function($u) {
    $u->billing()
        ->save( factory(App\Billing::class)->make() );
    $u->products()
        ->saveMany(factory(App\Product::class,20)->make());
    $u->posts()
        ->saveMany(factory(App\Post::class,15)->make());
}); */

$factory->define(User::class, function (Faker $faker) {
    $fullname_array = explode(' ', $faker->name);

    $f_name = $fullname_array[0];
    $l_name = $fullname_array[1];
    $acc_stat = 1;
    $stat = new AccountStatus(AccountStatus::ACTIVE);

    return [
        'first_name' => $f_name,
        'last_name' => $l_name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'cust_country' => $faker->country,
        'cust_city' => $faker->city,
        'cust_street' => $faker->streetName,
        'phone_number' => '5016244690',
        'account_status' => $stat->value,
        'seller_panel_enabled' => $acc_stat,
        'password' =>  Hash::make('Asdf1234'), // password
        'remember_token' => Str::random(10),
    ];
    /*return [
        'first_name' => 'Delroy',
        'last_name' => 'Coc',
        'email' => 'delroycoc@yahoo.com',
        'email_verified_at' => now(),
        'cust_country' => 'Belize',
        'cust_city' => 'Belmopan',
        'cust_street' => 'St Luke',
        'phone_number' => '5016123216',
        'account_status' => $stat->value,
        'seller_panel_enabled' => $acc_stat,
        'password' =>  Hash::make('Admin123'), // password
        'remember_token' => Str::random(10),
    ];*/
});
