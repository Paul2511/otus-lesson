<?php


namespace App\Services\Articles;


use App\Models\Article;
use App\Services\Articles\Handlers\CreateArticleHandler;
use App\Services\Articles\Handlers\DeleteArticleHandler;
use App\Services\Articles\Handlers\SearchArticleHandler;
use App\Services\Articles\Handlers\UpdateArticleHandler;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleService
{

    private CreateArticleHandler $createArticleHandler;
    private UpdateArticleHandler $updateArticleHandler;
    private DeleteArticleHandler $deleteArticleHandler;
    private SearchArticleHandler $searchArticleHandler;

    public function __construct(
        CreateArticleHandler $createArticleHandler,
        UpdateArticleHandler $updateArticleHandler,
        DeleteArticleHandler $deleteArticleHandler,
        SearchArticleHandler $searchArticleHandler
    )
    {
        $this->createArticleHandler = $createArticleHandler;
        $this->updateArticleHandler = $updateArticleHandler;
        $this->deleteArticleHandler = $deleteArticleHandler;
        $this->searchArticleHandler = $searchArticleHandler;
    }

    public function searchArticle(int $pregPage, array $with = []): LengthAwarePaginator
    {
       return $this->searchArticleHandler->handle($pregPage, $with);
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
