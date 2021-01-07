<?php

namespace Tests\Feature\Http\Controllers\Admin\Surveys\AdminSurveysController;

use App\Models\Survey;
use App\Models\User;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminSurveysControllerUpdateTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();

        $surveyData = ['name' => __METHOD__];

        $this
            ->put(AdminRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testAsUser()
    {
        $user = UsersGenerator::generate();
        $survey = SurveyGenerator::generate([], $user);

        $surveyData = ['name' => __METHOD__];

        $this
            ->actingAs($user)
            ->put(AdminRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(302);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testOtherElementAsUser()
    {
        $survey = SurveyGenerator::generate();
        $user = UsersGenerator::generate();

        $surveyData = ['name' => __METHOD__];

        $this
            ->actingAs($user)
            ->put(AdminRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(403);
    }

    public function testOtherElementAsAdmin()
    {
        $survey = SurveyGenerator::generate();
        $user = UsersGenerator::generateAdmin();

        $surveyData = ['name' => __METHOD__];

        $this
            ->actingAs($user)
            ->put(AdminRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(302);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

    public function testOtherElementAsModerator()
    {
        $survey = SurveyGenerator::generate();
        $user = UsersGenerator::generateModerator();

        $surveyData = ['name' => __METHOD__];

        $this
            ->actingAs($user)
            ->put(AdminRoutes::surveysUpdate($survey), $surveyData)
            ->assertStatus(302);

        $this->assertDatabaseHas('surveys', $surveyData);
    }

}
