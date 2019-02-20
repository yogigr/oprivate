<?php

use Faker\Generator as Faker;

$factory->define(App\Achievement::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'year' => $faker->year(),
        'name' => $faker->sentence($nbWords=3)
    ];
});
