<?php

use Faker\Generator as Faker;

$factory->define(App\Geolocation::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'latitude' => $faker->latitude($min=-7.077669, $max=-6.584047),
        'longitude' => $faker->longitude($min=107.515139, $max=108.329259)
    ];
});
