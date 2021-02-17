<?php

namespace Tests\Feature\Http\Controllers\Api\Surveys\ApiSurveysController;

use App\Models\Survey;
use App\Models\User;
use App\Services\Routes\Providers\Api\ApiRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class ApiSurveysControllerUpdateTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();

        $surveyData = ['name' => __METHOD__];

        $this
            ->putJson(ApiRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(401);
    }

    public function testAsUser()
    {
        $user = UsersGenerator::generate();
        $survey = SurveyGenerator::generate([], $user);

        $surveyData = ['name' => __METHOD__];

        $this
            ->actingAs($user, 'api')
            ->putJson(ApiRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(200);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testOtherElementAsUser()
    {
        $survey = SurveyGenerator::generate();
        $user = UsersGenerator::generate();

        $surveyData = ['name' => __METHOD__];

        $this
            ->actingAs($user, 'api')
            ->putJson(ApiRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(403);
    }

    public function testOtherElementAsAdmin()
    {
        $survey = SurveyGenerator::generate();
        $user = UsersGenerator::generateAdmin();

        $surveyData = ['name' => __METHOD__];

        $this
            ->actingAs($user, 'api')
            ->putJson(ApiRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(200);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testOtherElementAsModerator()
    {
        $survey = SurveyGenerator::generate();
        $user = UsersGenerator::generateModerator();

        $surveyData = ['name' => __METHOD__];

        $this
            ->actingAs($user, 'api')
            ->putJson(ApiRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(200);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

}
