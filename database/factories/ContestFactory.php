<?php

use Faker\Generator as Faker;

$factory->define(App\Contest::class, function (Faker $faker) {
    $prize  = App\Prize::inRandomOrder()->first();
    $user   = App\User::inRandomOrder()->first();
    return [
        'name'              => $faker->sentence(2),
        'slug'              => $faker->slug(2),
        'language'          => 'en',
        'private'           => 0,
        'start'             => $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 1 days'),
        'end'               => $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 90 days'),
        'email_prize'       => 1,
        'display_winner'    => 1,
        'pick'              => 1,
        'prize_claim_note'  => ' ',
        'url'               => $faker->slug,
        'nbr_contestants'   => 0,
        'images'            => $faker->imageUrl(),
        'prize_id'          => $prize->id,
        'user_id'           => $user->id,
    ];
});
