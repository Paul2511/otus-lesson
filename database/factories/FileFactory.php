<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\File;
use Faker\Generator as Faker;

$factory->define(File::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'fid' => $faker->uuid,
        'url' => config('files.default.url_avatar'),
    ];
});
