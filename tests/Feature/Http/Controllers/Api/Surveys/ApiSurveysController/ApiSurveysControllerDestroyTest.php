<?php

namespace Tests\Feature\Http\Controllers\Api\Surveys\ApiSurveysController;

use App\Services\Routes\Providers\Api\ApiRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class ApiSurveysControllerDestroyTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();

        $this
            ->deleteJson(ApiRoutes::surveysDestroy($survey))
            ->assertStatus(401);
    }

    public function testAsUser()
    {
        $user = UsersGenerator::generate();
        $surveyData = ['name' => __METHOD__];
        $survey = SurveyGenerator::generate($surveyData, $user);

        $this
            ->actingAs($user, 'api')
            ->deleteJson(ApiRoutes::surveysDestroy($survey))
            ->assertStatus(200);

        $this->assertDatabaseMissing('surveys', $surveyData);
    }

    public function testOtherElementAsUser()
    {
        $surveyData = ['name' => __METHOD__];

        $survey = SurveyGenerator::generate($surveyData);

        $user = UsersGenerator::generate();

        $this
            ->actingAs($user, 'api')
            ->deleteJson(ApiRoutes::surveysDestroy($survey), $surveyData)
            ->assertStatus(403);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testOtherElementAsModerator()
    {
        $surveyData = ['name' => __METHOD__];

        $survey = SurveyGenerator::generate($surveyData);

        $user = UsersGenerator::generateModerator();

        $this
            ->actingAs($user, 'api')
            ->deleteJson(ApiRoutes::surveysDestroy($survey), $surveyData)
            ->assertStatus(403);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testOtherElementAsAdmin()
    {
        $surveyData = ['name' => __METHOD__];

        $survey = SurveyGenerator::generate($surveyData);

        $user = UsersGenerator::generateAdmin();

        $this
            ->actingAs($user, 'api')
            ->deleteJson(ApiRoutes::surveysDestroy($survey), $surveyData)
            ->assertStatus(200);

        $this->assertDatabaseMissing('surveys', $surveyData);
    }

}
