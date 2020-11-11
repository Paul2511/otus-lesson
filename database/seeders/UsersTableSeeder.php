<?php

namespace Database\Seeders;

use DB;
use Hash;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create('Ru_RU');
      DB::table('users')->insert([
          'inn' => $faker->unique()->numberBetween(1110000000,9999999999),
          'first_name' => $faker->firstName,
          'last_name' => $faker->lastName,
          'middle_name' => $faker->firstName,
          'position' => $faker->word,
          'phone' => $faker->unique()->numberBetween(9990000000,9999999999),
          'email' => $faker->unique()->safeEmail,
          'password' => Hash::make('password'),
          'otp' => $faker->unique()->numberBetween(0000,9999),
          'active' => $faker->boolean,
          'email_verified_at' => now(),
          'remember_token' => Hash::make('token'),
          'created_at' => now(),
          'updated_at' => now(),
      ]);
    }
}
