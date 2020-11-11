<?php

namespace Database\Seeders;

use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = \Faker\Factory::create();
      DB::table('payments')->insert([
          'value' => $faker->randomFloat(null,0),
          'billed' => now(),
          'payed' => now(),
          'status' => $faker->randomDigit,
          'created_at' => now(),
          'updated_at' => now(),
      ]);
    }
}
// $table->decimal('value');
// $table->datetime('billed');
// $table->datetime('payed');
// $table->enum('status', ['billed', 'payed', 'pending', 'refund', 'cancel']);
// $table->timestamps();
