<?php

use Faker\Generator as Faker;

$factory->define(App\Prize::class, function (Faker $faker) {
    $currency = App\Currency::where('name','Dollars')->first();
    return [
        'name'          => $faker->sentence(4),
        'user_id'       => 1,
        'currency_id'   => $currency->id,
        'description'   => $faker->paragraph(3),
        'images'        => $faker->imageUrl(),
        'type'          => 1,
        'status'        => 1,
        'created_at'    => date('Y-m-d H:i:s'),
        'updated_at'    => date('Y-m-d H:i:s')
    ];
});
