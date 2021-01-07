<?php

namespace Tests\Feature\Http\Controllers\Admin\Surveys\AdminSurveysController;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminSurveysControllerStoreTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $response = $this->post(
            AdminRoutes::surveysStore(),
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
            ->actingAs(UsersGenerator::generate())
            ->post(
                AdminRoutes::surveysStore(),
                SurveyGenerator::generateRaw($surveyData)
            );

        $response->assertStatus(302);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testAsAdmin()
    {
        $surveyData = ['name' => __METHOD__];

        $response = $this
            ->actingAs(UsersGenerator::generateAdmin())
            ->post(
                AdminRoutes::surveysStore(),
                SurveyGenerator::generateRaw($surveyData)
            );

        $response->assertStatus(302);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testAsModerator()
    {
        $surveyData = ['name' => __METHOD__];

        $response = $this
            ->actingAs(UsersGenerator::generateModerator())
            ->post(
                AdminRoutes::surveysStore(),
                SurveyGenerator::generateRaw($surveyData)
            );

        $response->assertStatus(302);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

}
