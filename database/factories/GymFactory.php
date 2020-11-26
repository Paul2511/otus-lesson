<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gym;
use Faker\Generator as Faker;

$factory->define(Gym::class, function (Faker $faker) {
    return [
        'title' => $faker->randomElement(SectionSeeder::getDefaultSections()),
        'number' => $faker->numberBetween(100, 120),
        'status' => $faker->randomElement(Gym::STATUSES),
    ];
});
