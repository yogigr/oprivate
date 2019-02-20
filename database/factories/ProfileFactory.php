<?php

use Faker\Generator as Faker;

$factory->define(App\Profile::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'sex' => $faker->randomElement(['m', 'f']),
        'birth_place' => $faker->city,
        'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'about' => $faker->sentence($nbWords=30)
    ];
});
