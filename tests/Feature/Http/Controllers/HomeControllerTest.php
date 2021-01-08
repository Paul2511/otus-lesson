<?php

namespace Tests\Feature\Http\Controllers;

use App\Services\Routes\Providers\Admin\AdminRoutes;
use App\Services\Routes\Providers\PublicRoutes\PublicRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Generators\UsersGenerator;
use Tests\TestCase;


class HomeControllerTest extends TestCase
{
    use RefreshDatabase;


    public function testAsDefaultUser()
    {
        $this
            ->get(PublicRoutes::home())
            ->assertStatus(200);
    }

    public function testError()
    {
        $this
            ->actingAs(UsersGenerator::generate())
            ->get(route('debug.error'))
            ->assertStatus(500);
    }

    /*public function testAsUser()
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
    }*/

}
