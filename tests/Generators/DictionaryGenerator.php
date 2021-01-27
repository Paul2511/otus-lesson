<?php


namespace Tests\Generators;


use App\Models\Context;
use App\Models\Dictionary;
use App\Models\User;
use App\Models\Word;

class DictionaryGenerator
{
    private $dictionariesCount;
    private $wordsCount;
    private $contextsCount;

    public function __construct($dictionariesCount = 1, $wordsCount = 5, $contextsCount = 2)
    {
        $this->dictionariesCount = $dictionariesCount;
        $this->wordsCount = $wordsCount;
        $this->contextsCount = $contextsCount;
    }

    public function generateDictionaryWithRelations(User $user): Dictionary
    {
        return Dictionary::factory()
            ->has(
                Word::factory()
                    ->count($this->wordsCount)
                    ->has(
                        Context::factory()
                            ->count($this->contextsCount)
                    )
            )
            ->state([
                'user_id' => $user->id
            ])
            ->create();
    }

    public function getTotalDictionariesCount(): int
    {
        return $this->dictionariesCount;
    }

    public function getTotalWordsCount(): int
    {
        return $this->dictionariesCount * $this->wordsCount;
    }

    public function getTotalContextsCount(): int
    {
        return $this->dictionariesCount * $this->wordsCount * $this->contextsCount;
    }
}
