<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CardUser;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(CardUser::class, function (Faker $faker) {
    return [
        'start' => Carbon::now()->format('Y-m-d'),
        'end' => Carbon::now()->addDays(random_int(1, 365))->format('Y-m-d'),
        'status' => $faker->randomElement(CardUser::STATUSES),
    ];
});
