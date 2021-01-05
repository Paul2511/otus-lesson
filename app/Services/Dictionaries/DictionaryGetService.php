<?php


namespace App\Services\Dictionaries;


use App\Models\Dictionary;
use App\Models\Word;

class DictionaryGetService
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getDictionariesList()
    {
        return Dictionary::with('words')
            ->orderByDesc('id')
            ->paginate(10);
    }

    /**
     * @param int $dictionary_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getDictionaryWords(int $dictionary_id)
    {
        return Word::where('dictionary_id', $dictionary_id)
            ->orderByDesc('id')
            ->with('contexts')
            ->paginate(10);
    }
}
