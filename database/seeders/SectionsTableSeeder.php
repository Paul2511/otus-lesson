<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::factory(50)
            ->create()
            ->each(function(Section $section) {
                $section->parent_id = Section::all()->random()->id;
                $section->save();
            });
    }
}
