<?php

namespace Database\Seeders;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create();
      DB::table('documents')->insert([
          'name' => $faker->word,
          'type' => $faker->word,
          'url' => $faker->url,
          'created_at' => now(),
          'updated_at' => now(),
      ]);
    }
}
