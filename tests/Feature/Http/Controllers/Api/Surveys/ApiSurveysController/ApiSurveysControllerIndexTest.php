<?php

namespace Tests\Feature\Http\Controllers\Api\Surveys\ApiSurveysController;

use App\Services\Routes\Providers\Api\ApiRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;

class ApiSurveysControllerIndexTest extends TestCase
{
    use RefreshDatabase;

    public function testAsDefaultUser()
    {
        $response = $this->getJson(ApiRoutes::surveysIndex());

        $response->assertStatus(401);
    }

    public function testAsUser()
    {
        $user = UsersGenerator::generateAdmin();

        $response = $this
            ->actingAs($user, 'api')
            ->getJson(ApiRoutes::surveysIndex());

        $response->assertStatus(200);
    }

    public function testListAsUser()
    {
        $user = UsersGenerator::generate();
        $survey = SurveyGenerator::generate([], $user);


        $response = $this
            ->actingAs($user, 'api')
            ->getJson(ApiRoutes::surveysList(1));

        $response->assertStatus(200)
                 ->assertJsonCount(1)
                 ->assertJsonFragment(['name' => $survey->name]);
    }
}
