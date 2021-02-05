<?php


namespace App\Http\Resources\PetType;

use App\Models\PetType;
use App\Services\Localise\Locale;
use Illuminate\Http\Resources\Json\ResourceCollection;


class PetTypeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $fields = [
            ['key'=>'id', 'label'=>'id', 'sort'=>true],
            ['key'=>'slug', 'label'=>__('main.slug'), 'sort'=>true]
        ];

        $locales = Locale::$availableLocales;
        foreach ($locales as $locale) {
            $fields[] = [
                'key' => 'locale_' . $locale,
                'label' => __('main.value'). ' '. $locale
            ];
        }

        return [
            'data' => $this->collection,
            'fields' => $fields,
        ];
    }
}