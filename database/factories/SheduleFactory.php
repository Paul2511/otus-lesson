<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Schedule;
use Faker\Generator as Faker;

$factory->define(Schedule::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeInInterval('+0 days', '+1 month'),
        'status' => $faker->randomElement(Schedule::getStatuses())
    ];
});
