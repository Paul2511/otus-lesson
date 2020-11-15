<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Service;
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
        Service::factory()->times(1)->make();
    }
}
