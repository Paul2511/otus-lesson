<?php

namespace Tests\Feature\Http\Controllers\Admin\Surveys\AdminSurveysController;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminSurveysControllerShowTest extends TestCase
{
    use RefreshDatabase;


    public function testSelfElementAsDefaultUser()
    {
        $user = UsersGenerator::generate();
        $this->actingAs($user);

        $survey = SurveyGenerator::generate([], $user);

        $this
            ->get(AdminRoutes::surveysShow($survey))
            ->assertStatus(200);
    }

    public function testOtherElementAsDefaultUser()
    {
        $userOwner = UsersGenerator::generate();
        $this->actingAs(UsersGenerator::generate());

        $survey = SurveyGenerator::generate([], $userOwner);

        $this
            ->get(AdminRoutes::surveysShow($survey))
            ->assertStatus(403);
    }

    public function testOtherElementAsAdmin()
    {
        $userOwner = UsersGenerator::generate();
        $this->actingAs(UsersGenerator::generateAdmin());

        $survey = SurveyGenerator::generate([], $userOwner);

        $this
            ->get(AdminRoutes::surveysShow($survey))
            ->assertStatus(200);
    }

    public function testOtherElementAsModerator()
    {
        $userOwner = UsersGenerator::generate();
        $this->actingAs(UsersGenerator::generateModerator());

        $survey = SurveyGenerator::generate([], $userOwner);

        $this
            ->get(AdminRoutes::surveysShow($survey))
            ->assertStatus(200);
    }

}
