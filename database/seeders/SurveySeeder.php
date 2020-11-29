<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use Database\Factories\QuestionFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class SurveySeeder extends Seeder
{
    public function run()
    {
        Survey::factory()
            ->times(30)
            ->has(
                Question::factory()
                    ->has(Answer::factory()->count(4))
                    ->count(15)
            )
            ->create();
    }
}
