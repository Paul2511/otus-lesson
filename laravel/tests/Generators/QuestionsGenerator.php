<?php


namespace Tests\Generators;


use App\Models\Question;

class QuestionsGenerator
{
    public static function generateEmptyQuestion(): Question
    {
        return Question::factory()->create();
    }
}
