<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    $fakerRu = \Faker\Factory::create('ru_RU');

    return [
        'title' => $fakerRu->text(100),
        'text' => $fakerRu->text(500),
        'status' => $faker->randomElement(Message::getStatuses()),
    ];
});
