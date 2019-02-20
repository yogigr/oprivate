<?php

use Faker\Generator as Faker;

$factory->define(App\Educational::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'start_year' => $faker->year(),
        'end_year' => $faker->year(),
        'name' => $faker->sentence($nbWords=3)
    ];
});
