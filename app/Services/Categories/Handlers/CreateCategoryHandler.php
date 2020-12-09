<?php

namespace App\Services\Categories\Handlers;

use \App\Services\Categories\Repositories\EloquentCategoriesRepository;
use \App\Services\Categories\DTO\CreateCategoryDTO;

class CreateCategoryHandler {
    
    private EloquentCategoriesRepository $eloquentCategoriesRepository;
    
    public function __construct(
        EloquentCategoriesRepository $eloquentCategoriesRepository
        ) {
        $this->eloquentCategoriesRepository = $eloquentCategoriesRepository;
    }
    
    public function handler(CreateCategoryDTO $createCategoryDTO):Category{
        $this->eloquentCategoriesRepository->createFromArray($createCategoryDTO->toArray());
    }
}
