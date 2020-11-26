<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\NotificationUser;
use Faker\Generator as Faker;

$factory->define(NotificationUser::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement(NotificationUser::STATUSES)
    ];
});
