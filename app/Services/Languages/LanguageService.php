<?php


namespace App\Services\Languages;


use Illuminate\Support\Facades\Cache;

class LanguageService
{
    /**
     * @return array
     */
    public function getAppLanguages():array{

        $languages = Cache::remember('languages',3600,function (){
            $out = [];
            foreach (config(app . locales) ?? [] as $localy) {
                $out[] = ['title' => __('general.languages.' . $localy), 'code' => $localy];
            }
            return $out;
        });

        return $languages;
    }
}
