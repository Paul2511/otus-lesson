<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    $fakerRu = \Faker\Factory::create('ru_RU');

    return [
        'role' => User::ROLE_ANONYMOUS,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'first_name' => $fakerRu->firstName,
        'middle_name' => 'Иванович',
        'last_name' => $fakerRu->lastName,
        'phone' => $faker->phoneNumber,
        'birthday' => $faker->date('Y-m-d'),
        'file_id' => 1,
    ];
});

foreach (User::ROLES as $role) {
    $factory->state(User::class, $role, [
        'role' => $role,
    ]);
}
