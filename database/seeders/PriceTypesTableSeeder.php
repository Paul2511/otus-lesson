<?php

namespace Database\Seeders;

use App\Models\PriceType;
use Illuminate\Database\Seeder;

class PriceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PriceType::factory(50)
            ->create();
    }
}
