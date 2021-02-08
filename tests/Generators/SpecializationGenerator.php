<?php


namespace Tests\Generators;

use App\Models\Specialization;
use App\Models\Translate;
use App\Services\Localise\Locale;

class SpecializationGenerator
{
    /**
     * @param int|null $count
     * @param array|null $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public static function generate(?int $count = 3)
    {
        $locales = Locale::$availableLocales;
        $specializations = Specialization::factory()
            ->count($count)
            ->create()->each(function (Specialization $specialization) use ($locales) {
                foreach ($locales as $locale) {
                    Translate::factory()->createOne([
                        'type' => $specialization->getModelName(),
                        'row_id'=>$specialization->id,
                        'locale'=>$locale
                    ]);
                }
                $specialization->refresh();
            });

        return $specializations;
    }
}