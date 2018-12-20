<?php

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
//\Illuminate\Support\Facades\Hash::make('admin')
$factory->define(App\User::class, function (Faker $faker) {
    $rank = mt_rand(0,1)?1:12;
    return [
            'name' => 'admin',
            'email' => $faker->companyEmail(),
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('passer'), // secret
            'rank' => $rank,
            'remember_token' => str_random(10),
        ];
});
