<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Str;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regions = [
            [
                'title' => 'Ташкентская область',
                'slug' => Str::slug('Ташкентская область'),
                'parent_id' => null
            ],
            [
                'title' => 'Самаркандская область',
                'slug' => Str::slug('Самаркандская область'),
                'parent_id' => null
            ],
            [
                'title' => 'Ферганская область',
                'slug' => Str::slug('Ферганская область'),
                'parent_id' => null
            ],
            [
                'title' => 'Ташкент',
                'slug' => Str::slug('Ташкент'),
                'parent_id' => 1,
            ],
            [
                'title' => 'Чирчик',
                'slug' => Str::slug('Чирчик'),
                'parent_id' => 1,
            ],
            [
                'title' => 'Кибрай',
                'slug' => Str::slug('Кибрай'),
                'parent_id' => 1,
            ],
            [
                'title' => 'Самарканд',
                'slug' => Str::slug('Самарканд'),
                'parent_id' => 2,
            ],
            [
                'title' => 'Акташ',
                'slug' => Str::slug('Акташ'),
                'parent_id' => 2,
            ],
            [
                'title' => 'Фергана',
                'slug' => Str::slug('Фергана'),
                'parent_id' => 3,
            ],
            [
                'title' => 'Коканд',
                'slug' => Str::slug('Коканд'),
                'parent_id' => 3,
            ],
            [
                'title' => 'Маргелан',
                'slug' => Str::slug('Маргелан'),
                'parent_id' => 3,
            ],
        ];

        foreach ($regions as $region) {
            Region::create($region);
        }
    }
}
