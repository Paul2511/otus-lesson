<?php


namespace Tests\Generators;


use App\Models\Question;
use App\Models\Survey;
use Illuminate\Database\Eloquent\Factories\Factory;


class QuestionGenerator
{

    private static function factory(?Survey $survey = null, ?array $data = []): Factory
    {
        if (!empty($survey)) {
            $data['survey_id'] = $survey;
        } elseif ($survey === null) {
            $data['survey_id'] = SurveyGenerator::generate();
        }

        return Question::factory($data);
    }

    public static function generate(?Survey $survey = null, ?array $data = []): Question
    {
        return static::factory($survey, $data)->create();
    }

    public static function generateRaw(?Survey $survey, ?array $data = []): array
    {
        return static::factory($survey, $data)->raw();
    }

}
