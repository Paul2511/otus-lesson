<?php

namespace Tests\Feature\Http\Controllers\Admin\Surveys\AdminQuestionsController;

use App\Models\Survey;
use App\Models\User;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\QuestionGenerator;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminQuestionsControllerUpdateTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();
        $question = QuestionGenerator::generate($survey);

        $this
            ->put(AdminRoutes::questionsUpdate($survey, $question))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testSelfAsUser()
    {
        $user = UsersGenerator::generate();
        $survey = SurveyGenerator::generate([], $user);

        $question = QuestionGenerator::generate($survey);
        $questionData = ['name' => __METHOD__];

        $this
            ->actingAs($user)
            ->put(AdminRoutes::questionsUpdate($survey, $question), $questionData)
            ->assertStatus(302);

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function testAsUser()
    {
        $user1 = UsersGenerator::generate();
        $user2 = UsersGenerator::generate();

        $survey = SurveyGenerator::generate([], $user1);

        $question = QuestionGenerator::generate($survey);
        $questionData = ['name' => __METHOD__];

        $this
            ->actingAs($user2)
            ->put(AdminRoutes::questionsUpdate($survey, $question), $questionData)
            ->assertStatus(403);

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function testAsAdminUser()
    {
        $user1 = UsersGenerator::generate();
        $user2 = UsersGenerator::generateAdmin();

        $survey = SurveyGenerator::generate([], $user1);

        $question = QuestionGenerator::generate($survey);
        $questionData = ['name' => __METHOD__];

        $this
            ->actingAs($user2)
            ->put(AdminRoutes::questionsUpdate($survey, $question), $questionData)
            ->assertStatus(302);

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function testAsModeratorUser()
    {
        $user1 = UsersGenerator::generate();
        $user2 = UsersGenerator::generateModerator();

        $survey = SurveyGenerator::generate([], $user1);

        $question = QuestionGenerator::generate($survey);
        $questionData = ['name' => __METHOD__];

        $this
            ->actingAs($user2)
            ->put(AdminRoutes::questionsUpdate($survey, $question), $questionData)
            ->assertStatus(302);

        $this->assertDatabaseHas('questions', $questionData);
    }

}
