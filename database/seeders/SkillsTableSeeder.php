<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['title' => 'Английский язык', 'slug' => 'anglijskij-yazyk'],
            ['title' => 'Испанский язык', 'slug' => 'ispanskij-yazyk'],
            ['title' => 'Немецкий язык', 'slug' => 'nemeckij-yazyk'],
            ['title' => 'Французский язык', 'slug' => 'francuzskij-yazyk'],
            ['title' => 'Китайский язык', 'slug' => 'kitajskij-yazyk']
        ];

        foreach ($items as $item) {
            DB::table('skills')->insert($item);
        }
    }
}
