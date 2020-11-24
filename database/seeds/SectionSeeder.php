<?php

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (self::getDefaultSections() as $section) {
            factory(Section::class, 1)->states($section)->create();
        }
    }

    public static function getDefaultSections(): array
    {
        return [
            'Утренние программы',
            'Боди билдинг',
            'Стретчинг',
            'Фитнес',
            'Йога',
            'Детсткие программы',
        ];
    }
}
