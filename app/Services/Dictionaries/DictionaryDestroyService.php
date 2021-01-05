<?php


namespace App\Services\Dictionaries;


use App\Models\Dictionary;
use App\Models\Word;

class DictionaryDestroyService
{
    public static function destroyDictionaryWithRelations(Dictionary $dictionary): bool
    {
        // Удалим контексты использования для слов
        self::destroyDictionaryWordsContexts($dictionary);

        // Удалим слова словаря
        self::destroyDictionaryWords($dictionary);

        // Удалим словарь
        self::destroyDictionary($dictionary);

        return true;
    }

    protected static function destroyDictionary(Dictionary $dictionary): bool
    {
        if (!$dictionary->delete()) {
            return false;
        }

        return true;
    }

    protected static function destroyDictionaryWordsContexts(Dictionary $dictionary): bool
    {
        // Получим слова словаря с контекстоми использования
        $words = Word::where('dictionary_id', $dictionary->id)
            ->with('contexts')
            ->get();

        // Удалим контексты использования для слов
        foreach ($words as $word) {
            $word->contexts()->delete();
        }

        return true;
    }

    protected static function destroyDictionaryWords(Dictionary $dictionary): bool
    {
        Word::where('dictionary_id', $dictionary->id)
            ->delete();

        return true;
    }
}
