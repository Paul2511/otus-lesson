<?php

namespace Tests\Feature\Http\Controllers\Admin\Article;

use App\Services\Routes\Providers\AdminRoutes;
use Tests\Generators\ArticleGenerate;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class AdminArticleControllerDestroyTest extends TestCase
{

    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @group articleDestroy
     * @return void
     */
    public function testDestroyReturn302ForPain()
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
     * @group articleDestroy
     * @return void
     */
    public function testDestroyArticle()
    {
        $article = ArticleGenerate::article();

        $response = $this
            ->actingAs(UserGenerator::admin())
            ->delete(
                route(AdminRoutes::ADMIN_ARTICLE_DELETE, [
                    'article' => $article->id
                ]),
            );

        $response->assertStatus(302)
            ->assertRedirect(route(AdminRoutes::ADMIN_ARTICLE_INDEX));
    }
}
