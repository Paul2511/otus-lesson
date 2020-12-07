<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Seeder;


class SurveySeeder extends Seeder
{
    public function run()
    {
        $users = User::factory(3)->create();

        foreach ($users as $user) {
            Survey::factory()
                ->times(10)
                ->has(
                    Question::factory()
                        ->has(Answer::factory()->count(4))
                        ->count(15)
                )
                ->create(
                    [
                        'user_id' => $user->id,
                    ]
                );
        }
    }
}
