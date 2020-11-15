<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PetTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pet_types')->insert([
            ['slug'=>'unknown', 'title'=>'Не определено'],
            ['slug'=>'cat', 'title'=>'Кошка'],
            ['slug'=>'dog', 'title'=>'Собака']
        ]);
    }
}
