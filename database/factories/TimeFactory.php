<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Time;
use Faker\Generator as Faker;

$factory->define(Time::class, function (Faker $faker) {
    return [
        'start' => time(),
        'end' => time(),
        'status' => $faker->randomElement(Time::getStatuses()),
    ];
});

foreach (TimeSeeder::getDefaultTimes() as $i => $time) {
    $factory->state(Time::class, $i, [
        'start' => $time['start'],
        'end' => $time['end'],
    ]);
}
