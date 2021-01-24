<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['title' => 'A1', 'slug' => 'a1'],
            ['title' => 'A2', 'slug' => 'a2'],
            ['title' => 'B1', 'slug' => 'b1'],
            ['title' => 'B2', 'slug' => 'b2'],
            ['title' => 'C1', 'slug' => 'c1'],
            ['title' => 'C2', 'slug' => 'c2']
        ];

        foreach ($items as $item) {
            DB::table('levels')->insert($item);
        }
    }
}
