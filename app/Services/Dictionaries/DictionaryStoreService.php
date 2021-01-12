<?php


namespace App\Services\Dictionaries;


use App\Models\Dictionary;
use Illuminate\Support\Facades\Auth;

class DictionaryStoreService
{
    public function store(string $name): bool
    {
        $dictionary = new Dictionary();
        $dictionary->name = $name;
        $dictionary->user_id = Auth::id();

        if (!$dictionary->save()) {
            return false;
        }

        return true;
    }
}
