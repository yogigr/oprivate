<?php

use Faker\Generator as Faker;

$factory->define(App\Schedule::class, function (Faker $faker) {
	$days = App\Day::where('id', '>', 0)->pluck('id')->toArray();
	$times = App\Time::where('id', '>', 0)->pluck('id')->toArray();
	$students = App\User::where('role_id', '=', 3)->pluck('id')->toArray();
    return [
        'teacher_id' => null,
        'student_id' => $faker->randomElement($students),
        'day_id' => $faker->randomElement($days),
        'time_id' => $faker->randomElement($times),
        'is_active' => true,
        'note' => $faker->sentence($nbWords=10)
    ];
});
