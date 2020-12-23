<?php

namespace Tests\Feature\Http\Controllers\Admin\Surveys;

use App\Models\User;
use App\Services\Routes\Providers\Admin\AdminRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AdminSurveysControllerTest extends TestCase
{
    private $url = AdminRoutes::SURVEYS_INDEX;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAsDefaultUser()
    {
        $response = $this->get(route($this->url));

        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAsAdmin()
    {
        $response = $this->get(route($this->url));

        // $this->actingAs(User::factory())
        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAsModerator()
    {
        $response = $this->get(route($this->url));

        // $this->actingAs(User::factory())
        $response
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

}
