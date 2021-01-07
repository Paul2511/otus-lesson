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


class AdminQuestionsControllerDestroyTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();
        $question = QuestionGenerator::generate($survey);

        $this
            ->delete(AdminRoutes::questionsDestroy($survey, $question))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testSelfAsUser()
    {
        $user = UsersGenerator::generate();
        $survey = SurveyGenerator::generate([], $user);

        $questionData = ['name' => __METHOD__];
        $question = QuestionGenerator::generate($survey, $questionData);

        $this
            ->actingAs($user)
            ->delete(AdminRoutes::questionsDestroy($survey, $question))
            ->assertStatus(302);

        $this->assertDatabaseMissing('questions', $questionData);
    }

    public function testAsUser()
    {
        $user1 = UsersGenerator::generate();
        $user2 = UsersGenerator::generate();

        $survey = SurveyGenerator::generate([], $user1);

        $questionData = ['name' => __METHOD__];
        $question = QuestionGenerator::generate($survey, $questionData);

        $this
            ->actingAs($user2)
            ->delete(AdminRoutes::questionsDestroy($survey, $question))
            ->assertStatus(403);

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function testAsAdminUser()
    {
        $user1 = UsersGenerator::generate();
        $user2 = UsersGenerator::generateAdmin();

        $survey = SurveyGenerator::generate([], $user1);

        $questionData = ['name' => __METHOD__];
        $question = QuestionGenerator::generate($survey, $questionData);

        $this
            ->actingAs($user2)
            ->delete(AdminRoutes::questionsDestroy($survey, $question))
            ->assertStatus(302);

        $this->assertDatabaseMissing('questions', $questionData);
    }

    public function testAsModeratorUser()
    {
        $user1 = UsersGenerator::generate();
        $user2 = UsersGenerator::generateModerator();

        $survey = SurveyGenerator::generate([], $user1);

        $questionData = ['name' => __METHOD__];
        $question = QuestionGenerator::generate($survey, $questionData);

        $this
            ->actingAs($user2)
            ->delete(AdminRoutes::questionsDestroy($survey, $question))
            ->assertStatus(403);

        $this->assertDatabaseHas('questions', $questionData);
    }

}
