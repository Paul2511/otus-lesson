<?php


namespace App\Services\Words;


use App\Models\Context;
use App\Models\Word;

class WordDestroyService
{
    public function destroyWithRelations(Word $word): bool
    {
        $this->destroyWordContexts($word);
        $this->destroyWord($word);

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
