<?php

namespace Database\Seeders;
use App\Models\Company;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Faker\Factory;
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
        Company::factory()->times(10)->make();
    }
}
