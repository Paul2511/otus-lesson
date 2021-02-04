<?php


namespace App\Services\Articles;


use App\Models\Article;
use App\Services\Articles\Handlers\CreateArticleHandler;
use App\Services\Articles\Handlers\DeleteArticleHandler;
use App\Services\Articles\Handlers\UpdateArticleHandler;

class ArticleService
{

    private CreateArticleHandler $createArticleHandler;
    private UpdateArticleHandler $updateArticleHandler;
    private DeleteArticleHandler $deleteArticleHandler;

    public function __construct(
        CreateArticleHandler $createArticleHandler,
        UpdateArticleHandler $updateArticleHandler,
        DeleteArticleHandler $deleteArticleHandler

    )
    {
        $this->createArticleHandler = $createArticleHandler;
        $this->updateArticleHandler = $updateArticleHandler;
        $this->deleteArticleHandler = $deleteArticleHandler;
    }

    public function createArticle(array $data)
    {
        $this->createArticleHandler->handle($data);
    }

    public function updateArticle(Article $article, array $data)
    {
        $this->updateArticleHandler->handle($article, $data);
    }

    public function deleteArticle($article)
    {
        $this->deleteArticleHandler->handle($article);
    }

}
