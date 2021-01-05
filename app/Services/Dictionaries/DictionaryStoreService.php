<?php


namespace App\Services\Dictionaries;


use App\Models\Dictionary;

class DictionaryStoreService
{
    public static function store(string $name, int $user_id): bool
    {
        $dictionary = new Dictionary();
        $dictionary->name = $name;
        $dictionary->user_id = $user_id;

        if (!$dictionary->save()) {
            return false;
        }

        return true;
    }
}
