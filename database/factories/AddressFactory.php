<?php

use Faker\Generator as Faker;
use App\Province;
use App\City;

$factory->define(App\Address::class, function (Faker $faker) {
	$province_id = rand(1, Province::count());
	$cities = City::where('province_id', $province_id)->pluck('id')->toArray();
    return [
        'user_id' => null,
        'province_id' => $province_id,
        'city_id' => $faker->randomElement($cities),
        'address' => $faker->address,
        'postal_code' => $faker->postcode
    ];
});
