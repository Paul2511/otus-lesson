<?php

namespace Database\Seeders;

use App\Models\Sms;
use Illuminate\Database\Seeder;

class SmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sms::factory(20)->create();
    }
}
