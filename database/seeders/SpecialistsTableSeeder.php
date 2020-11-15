<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Specialist;
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
        Specialist::factory()->times(1)->make();
    }
}
