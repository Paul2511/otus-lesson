<?php


namespace App\Services\Words;


use App\Models\Context;
use App\Models\Word;

class WordDestroyService
{
    public static function destroyWithRelations(Word $word): bool
    {
        self::destroyWordContexts($word);
        self::destroyWord($word);

        return true;
    }

    public static function destroyWord(Word $word): bool
    {
        $word->delete();

        return true;
    }

    protected static function destroyWordContexts(Word $word): bool
    {
        Context::where('word_id', $word->id)
            ->delete();

        return true;
    }
}
