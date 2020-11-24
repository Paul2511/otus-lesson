<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Notification;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    $fakerRu = \Faker\Factory::create('ru_RU');

    return [
        'title' => 'title',
        'text' => $fakerRu->text(200),
        'type' => 10,
    ];
});

$types = array_merge(Notification::getTypesForGuest(), Notification::getTypesForAdmin());
foreach ($types as $name => $type) {
    $factory->state(Notification::class, $name, [
        'title' => $name,
        'type' => $type,
    ]);
}
