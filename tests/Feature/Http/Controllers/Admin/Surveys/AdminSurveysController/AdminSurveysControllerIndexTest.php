<?php

namespace Tests\Feature\Http\Controllers\Admin\Surveys\AdminSurveysController;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class AdminSurveysControllerIndexTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $response = $this->get(AdminRoutes::surveysIndex());

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testAsUser()
    {
        $response = $this
            ->actingAs(UsersGenerator::generate())
            ->get(AdminRoutes::surveysIndex());

        $response->assertStatus(200);
    }

    public function testCreateAsDefaultUser()
    {
        $response = $this->get(AdminRoutes::surveysCreate());

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    public function testCreateAsUser()
    {
        $response = $this
            ->actingAs(UsersGenerator::generate())
            ->get(AdminRoutes::surveysCreate());

        $response->assertStatus(200);
    }

}
