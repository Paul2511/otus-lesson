<?php

namespace Database\Seeders;

use App\Models\CoreSetting;
use Illuminate\Database\Seeder;

class CoreSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoreSetting::factory(20)->create();
    }
}
