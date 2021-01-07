<?php

namespace Tests\Feature\Http\Controllers\Admin\Surveys\AdminQuestionsController;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\SurveyGenerator;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminQuestionsControllerIndexTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();

        $this
            ->get(AdminRoutes::questionsIndex($survey))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testAsUser()
    {
        $survey = SurveyGenerator::generate();

        $this
            ->actingAs(UsersGenerator::generate())
            ->get(AdminRoutes::questionsIndex($survey))
            ->assertStatus(403);
    }

    public function testSelfElementAsUser()
    {
        $user = UsersGenerator::generate();
        $survey = SurveyGenerator::generate([], $user);

        $this
            ->actingAs($user)
            ->get(AdminRoutes::questionsIndex($survey))
            ->assertStatus(200);
    }

    public function testCreateAsDefaultUser()
    {
        $survey = SurveyGenerator::generate();

        $this
            ->get(AdminRoutes::questionsCreate($survey))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testCreateAsUser()
    {
        $survey = SurveyGenerator::generate();

        $response = $this
            ->actingAs(UsersGenerator::generate())
            ->get(AdminRoutes::questionsCreate($survey));

        $response->assertStatus(403);
    }

    public function testSelfElementCreateAsUser()
    {
        $user = UsersGenerator::generate();
        $survey = SurveyGenerator::generate([], $user);

        $response = $this
            ->actingAs($user)
            ->get(AdminRoutes::questionsCreate($survey));

        $response->assertStatus(200);
    }

}
