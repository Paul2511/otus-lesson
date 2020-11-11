<?php

namespace Database\Seeders;
use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create('Ru_RU');
      DB::table('companies')->insert([
          '1c_uuid' => 'fc15d28c-2885-4ec5-8208-d227ef03e4e9',
          'name' =>  $faker->word,
          'full_name' => $faker->word,
          'inn' => $faker->unique()->numberBetween(9990000000,9999999999),
          'kpp' => $faker->unique()->numberBetween(9990000000,9999999999),
          'ogrn' => mt_rand(100000000000, 999999999999),
          'ogrn_date' => now(),
          'phone' => $faker->unique()->numberBetween(9990000000,9999999999),
          'address_legal' => $faker->address,
          'address_actual' => $faker->address,
          'card_num' => $faker->unique()->numberBetween(10000000,9999999),
          'created_at' => now(),
          'updated_at' => now(),
      ]);
    }
}
