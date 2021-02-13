<?php

namespace Tests\Feature\Http\Controllers\Admin\Article;

use App\Services\Routes\Providers\AdminRoutes;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class AdminArticleControllerIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @return void
     */
    public function testIndexReturn302()
    {
        $response = $this->get(route(AdminRoutes::ADMIN_ARTICLE_INDEX));

        $response
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @return void
     */
    public function testIndexReturn200()
    {
        $response = $this
            ->actingAs(UserGenerator::admin())
            ->get(route(AdminRoutes::ADMIN_ARTICLE_INDEX));

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @return void
     */
    public function testIndexReturn403()
    {

        $response = $this
            ->actingAs(UserGenerator::plain())
            ->get(route(AdminRoutes::ADMIN_ARTICLE_INDEX));

        $response->assertStatus(403);
    }
}
