<?php


namespace App\Policies;


use App\Models\Dictionary;
use App\Models\User;

class DictionaryPolicy
{
    public function showDictionary(User $user, Dictionary $dictionary)
    {
        return $user->id === $dictionary->user_id;
    }
}
