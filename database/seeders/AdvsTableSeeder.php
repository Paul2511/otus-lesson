<?php

namespace Database\Seeders;

use App\Models\Adv;
use Illuminate\Database\Seeder;

class AdvsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Adv::factory(50)
            ->create();
    }
}
