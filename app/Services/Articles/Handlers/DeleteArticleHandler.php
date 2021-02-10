<?php


namespace App\Services\Articles\Handlers;


use App\Models\Article;
use App\Services\Articles\Repositories\EloquentArticleRepository;

class DeleteArticleHandler
{
    private EloquentArticleRepository $eloquentArticleRepository;

    public function __construct(
        EloquentArticleRepository $eloquentArticleRepository
    )
    {

        $this->eloquentArticleRepository = $eloquentArticleRepository;
    }

    public function handle(Article $article)
    {
        $this->eloquentArticleRepository->delete($article);
    }
}
