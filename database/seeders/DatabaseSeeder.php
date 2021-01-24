<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SkillsTableSeeder::class,
            LevelsTableSeeder::class,
            GroupSizesTableSeeder::class,
        ]);
    }
}
