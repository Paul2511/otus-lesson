<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 3; $i++) {
            DB::table('contexts')->insert([
                'word_id' => 1,
                'value'   => Str::random(7),
                'prefix'  => Str::random(10),
                'postfix' => Str::random(15),
            ]);
        }

        for ($i = 0; $i < 1; $i++) {
            DB::table('contexts')->insert([
                'word_id' => 2,
                'value'   => Str::random(7),
                'prefix'  => Str::random(10),
                'postfix' => Str::random(15),
            ]);
        }

        for ($i = 0; $i < 5; $i++) {
            DB::table('contexts')->insert([
                'word_id' => 3,
                'value'   => Str::random(7),
                'prefix'  => Str::random(10),
                'postfix' => Str::random(15),
            ]);
        }

        for ($i = 0; $i < 1; $i++) {
            DB::table('contexts')->insert([
                'word_id' => 4,
                'value'   => Str::random(7),
                'prefix'  => Str::random(10),
                'postfix' => Str::random(15),
            ]);
        }
    }
}
