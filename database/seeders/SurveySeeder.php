<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class SurveySeeder extends Seeder
{

    /**
     * TODO: разработать сидеры с "человеческим" контентом,
     *       использовать фабрики, faker или реальные фразы
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 20; $i++) {
            DB::table('surveys')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                // Генерирует строку из 2х слов рандомной длины
                'name'       => implode(
                    ' ',
                    [
                        Str::random(rand(5, 10)),
                        Str::random(rand(5, 10)),
                    ]
                ),

                // Генерирует строку из 3х слов рандомной длины
                'text'       => implode(
                    ' ',
                    [
                        Str::random(rand(8, 16)),
                        Str::random(rand(8, 16)),
                        Str::random(rand(8, 16)),
                    ]
                ),

                'picture'    => Str::random(10) . '.jpg',
            ]);
        }
    }
}
