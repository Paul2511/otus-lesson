<?php

namespace App\Services\Categories\Handlers;

use \App\Services\Categories\Repositories\EloquentCategoriesRepository;
use \App\Services\Categories\DTO\UpdateCategoryDTO;

class UpdateCategoryHandler {
    
    private EloquentCategoriesRepository $eloquentCategoriesRepository;
    
    public function __construct(
        EloquentCategoriesRepository $eloquentCategoriesRepository
        ) {
        $this->eloquentCategoriesRepository = $eloquentCategoriesRepository;
    }
    
    public function handler(UpdateCategoryDTO $updateCategoryDTO):Category{
        $this->eloquentCategoriesRepository->updateFromArray($updateCategoryDTO->toArray());
    }
}
