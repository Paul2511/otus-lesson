<?php


namespace Tests\Generators;

use App\Models\PetType;
use App\Models\Translate;
use App\Services\Localise\Locale;
use Illuminate\Support\Collection;

class PetTypeGenerator
{
    /**
     * @param int|null $count
     * @param array|null $data
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|mixed
     */
    public static function generate(?int $count = 3)
    {
        $locales = Locale::$availableLocales;
        $petTypes = PetType::factory()
            ->count($count)
            ->create()->each(function (PetType $petType) use ($locales) {
                foreach ($locales as $locale) {
                    Translate::factory()->createOne([
                        'type' => $petType->getModelName(),
                        'row_id'=>$petType->id,
                        'locale'=>$locale
                    ]);
                    $petType->refresh();
                }
            });

        return $petTypes;
    }
}