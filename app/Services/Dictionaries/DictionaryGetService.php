<?php


namespace App\Services\Dictionaries;


use App\Models\Dictionary;
use App\Models\Word;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class DictionaryGetService
{
    /**
     * @return LengthAwarePaginator
     */
    public function getDictionariesList(): LengthAwarePaginator
    {
        return Dictionary::with('words')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->paginate(10);
    }

    /**
     * @param int $dictionary_id
     * @return LengthAwarePaginator
     */
    public function getDictionaryWords(int $dictionary_id): LengthAwarePaginator
    {
        return Word::where('dictionary_id', $dictionary_id)
            ->orderByDesc('id')
            ->with('contexts')
            ->paginate(10);
    }
}
