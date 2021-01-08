<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Skachinsky\LocaleTranslator\Models\Translate;
use App\Services\Localise\Locale;
use Illuminate\Database\Seeder;

class SpecializationsTableSeeder extends Seeder
{

    private static $data = [
        ['slug'=>'unknown', 'ru'=>'Не определено', 'en'=>'Unknown'],
        ['slug'=>'therapist', 'ru'=>'Терапевт', 'en'=>'Therapist'],
        ['slug'=>'surgeon', 'ru'=>'Хирург', 'en'=>'Surgeon'],
        ['slug'=>'traumatologist', 'ru'=>'Травматолог', 'en'=>'Traumatologist'],
        ['slug'=>'cardiologist', 'ru'=>'Кардиолог', 'en'=>'Cardiologist'],
        ['slug'=>'dermatologist', 'ru'=>'Дерматолог', 'en'=>'Dermatologist'],
        ['slug'=>'dentist', 'ru'=>'Стоматолог', 'en'=>'Dentist'],
        ['slug'=>'groomer', 'ru'=>'Грумер', 'en'=>'Groomer']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$data as $item) {
            $specialization = Specialization::create(['slug'=>$item['slug']]);
            foreach (Locale::$availableLocales as $locale) {
                if (isset($item[$locale])) {
                    Translate::create([
                        'type'=>$specialization->getModelName(),
                        'row_id'=>$specialization->id,
                        'locale'=>$locale,
                        'value'=>$item[$locale]
                    ]);
                }
            }
        }
    }
}
