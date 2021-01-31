<?php

namespace Tests\Feature\Http\Controllers\Admin\Surveys\AdminSurveysController;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminSurveysControllerDestroyTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();

        $this
            ->delete(AdminRoutes::surveysDestroy($survey))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testAsUser()
    {
        $user = UsersGenerator::generate();
        $surveyData = ['name' => __METHOD__];
        $survey = SurveyGenerator::generate($surveyData, $user);

        $this
            ->actingAs($user)
            ->delete(AdminRoutes::surveysDestroy($survey))
            ->assertStatus(302);

        $this->assertDatabaseMissing('surveys', $surveyData);
    }

    public function testOtherElementAsUser()
    {
        $surveyData = ['name' => __METHOD__];

        $survey = SurveyGenerator::generate($surveyData);

        $user = UsersGenerator::generate();

        $this
            ->actingAs($user)
            ->delete(AdminRoutes::surveysDestroy($survey), $surveyData)
            ->assertStatus(403);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testOtherElementAsModerator()
    {
        $surveyData = ['name' => __METHOD__];

        $survey = SurveyGenerator::generate($surveyData);

        $user = UsersGenerator::generateModerator();

        $this
            ->actingAs($user)
            ->delete(AdminRoutes::surveysDestroy($survey), $surveyData)
            ->assertStatus(403);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testOtherElementAsAdmin()
    {
        $surveyData = ['name' => __METHOD__];

        $survey = SurveyGenerator::generate($surveyData);

        $user = UsersGenerator::generateAdmin();

        $this
            ->actingAs($user)
            ->delete(AdminRoutes::surveysDestroy($survey), $surveyData)
            ->assertStatus(302);

        $this->assertDatabaseMissing('surveys', $surveyData);
    }

}
