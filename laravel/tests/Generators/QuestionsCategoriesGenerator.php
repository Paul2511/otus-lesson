<?php


namespace Tests\Generators;


use App\Models\QuestionCategory;

class QuestionsCategoriesGenerator
{
    public static function generateEmptyCategoryQuestion(): QuestionCategory
    {
        return QuestionCategory::factory()->create();
    }
}
