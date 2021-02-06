<?php


namespace App\Services\Articles\Handlers;


use App\Services\Articles\Repositories\EloquentArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SearchArticleHandler
{

    private EloquentArticleRepository $eloquentArticleRepository;

    public function __construct(
        EloquentArticleRepository $eloquentArticleRepository
    )
    {
        $this->eloquentArticleRepository = $eloquentArticleRepository;
    }

    public function handle(int $pregPage, array $with = []): LengthAwarePaginator
    {
        return $this->eloquentArticleRepository->search($pregPage, $with);
    }
}
