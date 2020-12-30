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
            ['slug'=>'unknown', 'title_ru'=>'Не определено', 'title_en'=>'Unknown'],
            ['slug'=>'cat', 'title_ru'=>'Кошка', 'title_en'=>'Cat'],
            ['slug'=>'dog', 'title_ru'=>'Собака', 'title_en'=>'Dog']
        ]);
    }
}
