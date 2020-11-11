<?php

namespace Database\Seeders;

use DB;
use Carbon\Carbon;

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create();
      $enum = ['new', 'draft', 'to_sign', 'passed', 'recieved', 'closed', 'canceled', 'refused', 'refund', 'client', 'from'];
      DB::table('services')->insert([
          '1c_specialist_uuid' => 'c555d738-efd4-42ce-9f01-42c63995bfa0',
          '1c_service_uuid' => 'fcbb331b-51bd-4a47-89b0-e29da7bb537e',
          'sent_fms' => $faker->boolean(),
          'rnr_date' => now(),
          'inbox_num' => $faker->unique()->numberBetween(1000000,9999999),
          'rnr_status' => $faker->randomElement($enum),
          'rnr_ready' => now(),
          'rnr_recieved' => now(),
          'invite_sent' => now(),
          'invite_status' => $faker->randomElement($enum),
          'invite_po' => now(),
          'invite_recieved' => now(),
          'visa_sent' => now(),
          'visa_status' => $faker->randomElement($enum),
          'visa_po' => now(),
          'visa_recieved' => now(),
          'specialist_status' => $faker->randomElement($enum),
          'created_at' => now(),
          'updated_at' => now(),
      ]);
    }
}
