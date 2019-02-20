<?php

use Faker\Generator as Faker;

$factory->define(App\Rating::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'rating' => $faker->randomElement([1, 2, 3, 4, 5])
    ];
});
