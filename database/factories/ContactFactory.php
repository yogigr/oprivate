<?php

use Faker\Generator as Faker;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'user_id' => null,
        'phone_number' => $faker->phoneNumber,
        'wa_number' => $faker->phoneNumber,
        'facebook_url' => $faker->url,
        'instagram_url' => $faker->url
    ];
});
