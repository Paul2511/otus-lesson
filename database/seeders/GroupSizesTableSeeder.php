<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['title' => 'Индивидуальный план', 'slug' => 'individual', 'max_count' => '1'],
            ['title' => 'Группа', 'slug' => 'group'],
        ];

        foreach ($items as $item) {
            DB::table('group_sizes')->insert($item);
        }
    }
}
