<?php


namespace App\Services\Words;


use App\Models\Word;

class WordStoreService
{
    public function store(int $dictionary_id, string $value, string $translation): int
    {
        $word = new Word();
        $word->dictionary_id = $dictionary_id;
        $word->value = $value;
        $word->translation = $translation;

        if (!$word->save()) {
            return 0;
        }

        return $word->id;
    }
}
