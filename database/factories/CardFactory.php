<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Card;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    return [
        'title' => 'title',
        'count_month' => 0,
        'count_day' => 0,
        'price' => 0,
        'status' => $faker->randomElement(Card::STATUSES)
    ];
});

foreach (CardSeeder::getDefaultCards() as $i => $card) {
    $factory->state(Card::class, $i, [
        'title' => $card['title'],
        'count_month' => $card['count_month'],
        'count_day' => $card['count_day'],
        'price' => $card['price'],
    ]);
}
