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


class AdminQuestionsControllerStoreTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();

        $this
            ->post(
                AdminRoutes::questionsStore($survey),
                QuestionGenerator::generateRaw($survey)
            )
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testStoreAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();

        $this
            ->actingAs(UsersGenerator::generate())
            ->post(
                AdminRoutes::questionsStore($survey),
                QuestionGenerator::generateRaw($survey)
            )
            ->assertStatus(403);
    }

    public function testStoreSelfAsDefaultUser()
    {
        $user = UsersGenerator::generate();
        $survey = SurveyGenerator::generate([], $user);

        $questionData = ['name' => __METHOD__];

        $this
            ->actingAs($user)
            ->post(
                AdminRoutes::questionsStore($survey),
                QuestionGenerator::generateRaw($survey, $questionData)
            )
            ->assertStatus(302);

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function testStoreAsAdmin()
    {
        $survey = SurveyGenerator::generate();
        $user = UsersGenerator::generateAdmin();

        $questionData = ['name' => __METHOD__];

        $this
            ->actingAs($user)
            ->post(
                AdminRoutes::questionsStore($survey),
                QuestionGenerator::generateRaw($survey, $questionData)
            )
            ->assertStatus(302);

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function testAsModerator()
    {
        $survey = SurveyGenerator::generate();
        $user = UsersGenerator::generateModerator();

        $questionData = ['name' => __METHOD__];

        $this
            ->actingAs($user)
            ->post(
                AdminRoutes::questionsStore($survey),
                QuestionGenerator::generateRaw($survey, $questionData)
            )
            ->assertStatus(302);

        $this->assertDatabaseHas('questions', $questionData);
    }

}
