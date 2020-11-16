<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class AnswerSeeder extends Seeder
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
        for ($i = 0; $i < 80; $i++) {
            DB::table('answers')->insert([
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'question_id' => rand(1, 40),

                'correct' => rand(1, 10) % 2 === 1,

                // Генерирует строку из 3х слов рандомной длины
                'text'      => implode(
                    ' ',
                    [
                        Str::random(rand(8, 16)),
                        Str::random(rand(8, 16)),
                        Str::random(rand(8, 16)),
                    ]
                ),

                'pictures' => json_encode([
                    Str::random(10) . '.jpg',
                    Str::random(12) . '.jpg',
                ]),
            ]);
        }
    }
}
