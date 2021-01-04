<?php

namespace Database\Seeders;

use App\Models\PetType;
use App\Models\Translate;
use Illuminate\Database\Seeder;
use App\Services\Localise\Locale;

class PetTypesTableSeeder extends Seeder
{

    private static $data = [
        ['slug'=>'unknown', 'ru'=>'Не определено', 'en'=>'Unknown'],
        ['slug'=>'cat', 'ru'=>'Кошка', 'en'=>'Cat'],
        ['slug'=>'dog', 'ru'=>'Собака', 'en'=>'Dog']
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$data as $item) {
            $petType = PetType::create(['slug'=>$item['slug']]);
            foreach (Locale::$availableLocales as $locale) {
                if (isset($item[$locale])) {
                    Translate::create([
                        'type'=>Translate::TYPE_PET_TYPE,
                        'row_id'=>$petType->id,
                        'locale'=>$locale,
                        'value'=>$item[$locale]
                    ]);
                }
            }
        }
    }
}
