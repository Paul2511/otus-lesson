<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('words')->insert([
                'dictionary_id' => 1,
                'value'         => Str::random(7),
                'translation'   => Str::random(15),
            ]);
        }

        for ($i = 0; $i < 7; $i++) {
            DB::table('words')->insert([
                'dictionary_id' => 2,
                'value'         => Str::random(7),
                'translation'   => Str::random(15),
            ]);
        }

        for ($i = 0; $i < 21; $i++) {
            DB::table('words')->insert([
                'dictionary_id' => 3,
                'value'         => Str::random(7),
                'translation'   => Str::random(15),
            ]);
        }
    }
}
