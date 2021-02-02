<?php


namespace App\Services\Languages;


class LanguageService
{
    /**
     * @return array
     */
    public function getAppLanguages():array{
        $languages = [];
        foreach (config(app . locales) ?? [] as $localy) {
            $languages[] = ['title' => __('general.languages.' . $localy), 'code' => $localy];
        }
        return $languages;
    }
}
