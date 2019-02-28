<?php

use Faker\Generator as Faker;

use App\User;


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

$factory->define(User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->username,
        'email' => $faker->unique()->email,
        'password' => 'admin', // secret
        // 'dob' => date_random();
        'remember_token' => str_random(10),
    ];
});
