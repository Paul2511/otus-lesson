<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ScheduleUser;
use Faker\Generator as Faker;

$factory->define(ScheduleUser::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(ScheduleUser::STATUSES)
    ];
});
