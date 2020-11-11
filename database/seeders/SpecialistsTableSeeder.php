<?php

namespace Database\Seeders;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SpecialistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create('Ru_RU');
      DB::table('specialists')->insert([
          '1c_uuid' => 'fc15d28c-2885-4ec5-8208-d227ef03e4e9',
          '1c_specialist_uuid' => 'c555d738-efd4-42ce-9f01-42c63995bfa0',
          'first_name' => $faker->firstName,
          'last_name' => $faker->lastName,
          'middle_name' => $faker->firstName,
          'dob' => now(),
          'position' => $faker->word,
          'created_at' => now(),
          'updated_at' => now(),
      ]);
    }
}
