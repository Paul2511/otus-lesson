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
            ['slug'=>'unknown', 'title'=>'Не определено'],
            ['slug'=>'therapist', 'title'=>'Терапевт'],
            ['slug'=>'surgeon', 'title'=>'Хирург'],
            ['slug'=>'traumatologist', 'title'=>'Травматолог'],
            ['slug'=>'cardiologist', 'title'=>'Кардиолог'],
            ['slug'=>'dermatologist', 'title'=>'Дерматолог'],
            ['slug'=>'dentist', 'title'=>'Стоматолог'],
            ['slug'=>'groomer', 'title'=>'Грумер']
        ]);
    }
}
