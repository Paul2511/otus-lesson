<?php

namespace Tests\Feature\Http\Controllers\Api\Surveys\ApiSurveysController;

use App\Services\Routes\Providers\Api\ApiRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class ApiSurveysControllerStoreTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $response = $this->post(
            ApiRoutes::surveysStore(),
            SurveyGenerator::generateRaw()
        );

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testStoreAsDefaultUser()
    {
        $surveyData = ['name' => __METHOD__];

        $response = $this
            ->actingAs(UsersGenerator::generate(), 'api')
            ->postJson(
                ApiRoutes::surveysStore(),
                SurveyGenerator::generateRaw($surveyData)
            );

        $response->assertStatus(200);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testAsAdmin()
    {
        $surveyData = ['name' => __METHOD__];

        $response = $this
            ->actingAs(UsersGenerator::generateAdmin(), 'api')
            ->postJson(
                ApiRoutes::surveysStore(),
                SurveyGenerator::generateRaw($surveyData)
            );

        $response->assertStatus(200);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testAsModerator()
    {
        $surveyData = ['name' => __METHOD__];

        $response = $this
            ->actingAs(UsersGenerator::generateModerator(), 'api')
            ->postJson(
                ApiRoutes::surveysStore(),
                SurveyGenerator::generateRaw($surveyData)
            );

        $response->assertStatus(200);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

}
