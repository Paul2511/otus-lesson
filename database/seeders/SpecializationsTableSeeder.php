<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->insert([
            ['slug'=>'unknown', 'title_ru'=>'Не определено', 'title_en'=>'Unknown'],
            ['slug'=>'therapist', 'title_ru'=>'Терапевт', 'title_en'=>'Therapist'],
            ['slug'=>'surgeon', 'title_ru'=>'Хирург', 'title_en'=>'Surgeon'],
            ['slug'=>'traumatologist', 'title_ru'=>'Травматолог', 'title_en'=>'Traumatologist'],
            ['slug'=>'cardiologist', 'title_ru'=>'Кардиолог', 'title_en'=>'Cardiologist'],
            ['slug'=>'dermatologist', 'title_ru'=>'Дерматолог', 'title_en'=>'Dermatologist'],
            ['slug'=>'dentist', 'title_ru'=>'Стоматолог', 'title_en'=>'Dentist'],
            ['slug'=>'groomer', 'title_ru'=>'Грумер', 'title_en'=>'Groomer']
        ]);
    }
}
