<?php


namespace App\Services\Dictionaries;


use App\Models\Dictionary;
use App\Models\Word;

class DictionaryDestroyService
{
    public function destroyDictionaryWithRelations(Dictionary $dictionary): bool
    {
        // Удалим контексты использования для слов
        $this->destroyDictionaryWordsContexts($dictionary);

        // Удалим слова словаря
        $this->destroyDictionaryWords($dictionary);

        // Удалим словарь
        $this->destroyDictionary($dictionary);

        return true;
    }

    protected function destroyDictionary(Dictionary $dictionary): bool
    {
        if (!$dictionary->delete()) {
            return false;
        }

        return true;
    }

    protected function destroyDictionaryWordsContexts(Dictionary $dictionary): bool
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

    protected function destroyDictionaryWords(Dictionary $dictionary): bool
    {
        Word::where('dictionary_id', $dictionary->id)
            ->delete();

        return true;
    }
}
