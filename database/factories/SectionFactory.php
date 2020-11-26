<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Section;
use Faker\Generator as Faker;

$factory->define(Section::class, function (Faker $faker) {
    return [
        'title' => 'title',
        'status' => $faker->randomElement(Section::STATUSES),
    ];
});

foreach (SectionSeeder::getDefaultSections() as $section) {
    $factory->state(Section::class, $section, [
        'title' => $section,
    ]);
}
