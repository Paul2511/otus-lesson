<?php

namespace App\Services\Categories\Handlers;

use App\Services\Categories\Repositories\EloquentCategoriesRepository;

class ShowRootCategoriesHandler {
    
    private EloquentCategoriesRepository $EloquentCategoriesRepository;
    
    public function __construct(EloquentCategoriesRepository $EloquentCategoriesRepository) {
        $this->EloquentCategoriesRepository = $EloquentCategoriesRepository;
    }
    public function getCategory(int $id){
        return $this->EloquentCategoriesRepository->getCategory($id);
    }
    public function getRootCategoryList(int $rootCategoryId){
        return $this->EloquentCategoriesRepository->getRootCategories($rootCategoryId);
    }
    
     public function getSubCategoryList(int $rootCategoryId){
        return $this->EloquentCategoriesRepository->getSubCategories($rootCategoryId);
    }
}
