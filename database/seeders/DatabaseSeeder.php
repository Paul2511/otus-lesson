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
            NodeTypeSeeder::class,
            ColumnTypeSeeder::class,
            ColumnTypeNodeTypeSeeder::class,
            GroupTypeSeeder::class,
            StatusSeeder::class,
        ]);
    }
}
