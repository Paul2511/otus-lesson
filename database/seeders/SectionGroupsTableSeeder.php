<?php

namespace Database\Seeders;

use App\Models\SectionGroup;
use Illuminate\Database\Seeder;

class SectionGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SectionGroup::factory(50)
            ->create();
    }
}
