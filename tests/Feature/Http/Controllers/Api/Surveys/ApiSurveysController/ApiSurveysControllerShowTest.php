<?php

namespace Tests\Feature\Http\Controllers\Api\Surveys\ApiSurveysController;

use App\Services\Routes\Providers\Api\ApiRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class ApiSurveysControllerShowTest extends TestCase
{
    use RefreshDatabase;

    public function testSelfElementAsDefaultUser()
    {
        $user = UsersGenerator::generate();
        $this->actingAs($user, 'api');

        $survey = SurveyGenerator::generate([], $user);

        $this
            ->get(ApiRoutes::surveysShow($survey))
            ->assertStatus(200);
    }

    public function testOtherElementAsDefaultUser()
    {
        $userOwner = UsersGenerator::generate();
        $this->actingAs(UsersGenerator::generate(), 'api');

        $survey = SurveyGenerator::generate([], $userOwner);

        $this
            ->get(ApiRoutes::surveysShow($survey))
            ->assertStatus(403);
    }

    public function testOtherElementAsApi()
    {
        $userOwner = UsersGenerator::generate();
        $this->actingAs(UsersGenerator::generateAdmin(), 'api');

        $survey = SurveyGenerator::generate([], $userOwner);

        $this
            ->get(ApiRoutes::surveysShow($survey))
            ->assertStatus(200);
    }

    public function testOtherElementAsModerator()
    {
        $userOwner = UsersGenerator::generate();
        $this->actingAs(UsersGenerator::generateModerator(), 'api');

        $survey = SurveyGenerator::generate([], $userOwner);

        $this
            ->get(ApiRoutes::surveysShow($survey))
            ->assertStatus(200);
    }

}
