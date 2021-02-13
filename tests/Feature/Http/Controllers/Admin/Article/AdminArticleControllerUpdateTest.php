<?php

namespace Tests\Feature\Http\Controllers\Admin\Article;

use App\Services\Articles\Repositories\EloquentArticleRepository;
use App\Services\Routes\Providers\AdminRoutes;
use Tests\Generators\ArticleGenerate;
use Tests\Generators\UserGenerator;
use Tests\TestCase;

class AdminArticleControllerUpdateTest extends TestCase
{
    public function getEloquentArticleRepository()
    {
        return app(EloquentArticleRepository::class);
    }

    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @group articleUpdate
     * @return void
     */
    public function testUpdateReturn302ForPain()
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
     * @group articleUpdate
     * @return void
     */
    public function testUpdateArticleName()
    {
        $article = ArticleGenerate::article();
        $data = [
            'name' => 'Тестовая новость',
        ];
        $response = $this
            ->actingAs(UserGenerator::admin())
            ->put(
                route(AdminRoutes::ADMIN_ARTICLE_UPDATE, [
                    'article' => $article->id
                ]),
                $data
            );

        $updateArticle = $this->getEloquentArticleRepository()->find($article->id);
        $this->assertEquals($article->name, $updateArticle->name);
    }

    /**
     * A basic feature test example.
     * @group admin
     * @group article
     * @group articleUpdate
     * @return void
     */
    public function testUpdateArticleNoName()
    {
        $article = ArticleGenerate::article();
        $data = [
            'name' => '',
        ];
        $response = $this
            ->actingAs(UserGenerator::admin())
            ->put(
                route(AdminRoutes::ADMIN_ARTICLE_UPDATE, [
                    'article' => $article->id
                ]),
                $data
            )
        ->assertStatus(302)
        ->assertSessionHasErrors([
            'name'
        ]);

    }
}
