<?php


namespace App\Services\Dictionaries;


use App\Models\Dictionary;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DictionaryGetService
{
    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getDictionariesList()
    {
        return Dictionary::with('words')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->paginate(10);
    }

    /**
     * @param int $dictionary_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getDictionaryWords(int $dictionary_id)
    {
        $dictionary = Dictionary::findOrFail($dictionary_id);

        if (! Gate::allows('show-dictionary', $dictionary)) {
            abort(404);
        }

        return Word::where('dictionary_id', $dictionary_id)
            ->orderByDesc('id')
            ->with('contexts')
            ->paginate(10);
    }
}
