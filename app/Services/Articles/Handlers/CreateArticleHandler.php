<?php


namespace App\Services\Articles\Handlers;


use App\Services\Articles\Repositories\EloquentArticleRepository;

class CreateArticleHandler
{

    private EloquentArticleRepository $eloquentArticleRepository;

    public function __construct(
        EloquentArticleRepository $eloquentArticleRepository
    )
    {
        $this->eloquentArticleRepository = $eloquentArticleRepository;
    }

    public function handle(array $data)
    {
       $this->eloquentArticleRepository->createFromArray($data);
    }
}
