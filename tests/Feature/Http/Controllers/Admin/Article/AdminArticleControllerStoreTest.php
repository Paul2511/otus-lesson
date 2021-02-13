<?php

namespace Tests\Feature\Http\Controllers\Admin\Article;

use App\Services\Routes\Providers\AdminRoutes;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class AdminArticleControllerStoreTest extends TestCase
{
    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @group articleStore
     * @return void
     */
    public function testSoreReturn403ForPain()
    {
        $data = [];

        $response = $this
            ->from(route(AdminRoutes::ADMIN_ARTICLE_CREATE))
            ->actingAs(UserGenerator::plain())
            ->post(
                route(AdminRoutes::ADMIN_ARTICLE_STORE),
                $data
            );

        $response->assertStatus(302);
    }

    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @group articleStore
     * @return void
     */
    public function testSoreReturn200ForAdmin()
    {

        $data = [
            'name' => 'Тестовая новость',
            'slug' => 'test-news',
            'sort' => 100,
            'short_description' => 'Короткое описание',
            'description' => 'Тетовое описание Тетовое описание Тетовое описание Тетовое описание Тетовое описание',
            'meta_title' => 'Тестовая новость',
            'meta_description' => 'Тествое описание',
        ];
        $response = $this
            ->from(route(AdminRoutes::ADMIN_ARTICLE_CREATE))
            ->actingAs(UserGenerator::admin())
            ->post(
                route(AdminRoutes::ADMIN_ARTICLE_STORE),
                $data
            );

        $response->assertStatus(302)
            ->assertRedirect(route(AdminRoutes::ADMIN_ARTICLE_INDEX));
    }

    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @group articleStore
     * @return void
     */
    public function testSoreError()
    {
        $data = [];

        $response = $this
            ->from(route(AdminRoutes::ADMIN_ARTICLE_CREATE))
            ->actingAs(UserGenerator::admin())
            ->post(
                route(AdminRoutes::ADMIN_ARTICLE_STORE),
                $data
            );

        $response
            ->assertStatus(302)
            ->assertRedirect(route(AdminRoutes::ADMIN_ARTICLE_CREATE))
            ->assertSessionHasErrors(['name']);
    }
}
