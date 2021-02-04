<?php


namespace App\Services\Articles\Handlers;


use App\Models\Article;
use App\Services\Articles\Repositories\EloquentArticleRepository;

class UpdateArticleHandler
{

    private EloquentArticleRepository $eloquentArticleRepository;

    public function __construct(
        EloquentArticleRepository $eloquentArticleRepository
    )
    {

        $this->eloquentArticleRepository = $eloquentArticleRepository;
    }

    public function handle(Article $article,  array $data)
    {
        $this->eloquentArticleRepository->update($article, $data);
    }
}
