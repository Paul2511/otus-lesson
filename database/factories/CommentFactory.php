<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    $fakerRu = \Faker\Factory::create('ru_RU');

    return [
        'text' => $fakerRu->text(255),
        'status' => $faker->randomElement(Comment::getStatuses()),
    ];
});
