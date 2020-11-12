<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            [
                'full_name' => 'Прослушка записей',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Прослушка записей расширенная',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Онлайн статистика',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Эффективность',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Статистический отчет',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Сервисный отчет',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Отчет по обработанным звонкам',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Отчет по остаткам оказываемых услуг',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Отчет по выполнению квот',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table("resources")->insert($array);
    }
}
