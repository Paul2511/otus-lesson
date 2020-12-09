<?php

namespace App\Services\Categories;

use App\Models\Category;
use App\Services\Categories\DTO\CreateCategoryDTO;
use App\Services\Categories\DTO\UpdateCategoryDTO;
use App\Services\Categories\Handlers\CreateCategoryHandler;
use App\Services\Categories\Handlers\UpdateCategoryHandler;
use App\Services\Categories\Translators\CategoryStatusesTranslator;
use App\Services\Categories\Handlers\ShowRootCategoriesHandler;
use App\Http\Requests\Admin\AdminCategoriesStoreRequest;
use Illuminate\Support\Facades\View;

class CategoriesService {
    
    private CreateCategoryHandler $createCategoryHandler;
    private UpdateCategoryHandler $updateCategoryHandler;
    private CategoryStatusesTranslator $categoryStatusesTranslator;
    private ShowRootCategoriesHandler $ShowRootCategoriesHandler;
    
    public function __construct(
            UpdateCategoryHandler $updateCategoryHandler,
            CreateCategoryHandler $createCategoryHandler,
            CategoryStatusesTranslator $categoryStatusesTranslator,
            ShowRootCategoriesHandler $ShowRootCategoriesHandler
            ) {
        $this->createCategoryHandler = $createCategoryHandler;
        $this->updateCategoryHandler = $updateCategoryHandler;
        $this->categoryStatusesTranslator = $categoryStatusesTranslator;
        $this->ShowRootCategoriesHandler = $ShowRootCategoriesHandler;
    }
    public function showCategory(Category $category){
        
    }
    
    public function createCategory(CreateCategoryDTO $createCategoryDTO):Category{
        return $this->createCategoryHandler->handler($createCategoryDTO);
    }
    
    public function translateStatuses(string $lang):array
    {
        return $this->categoryStatusesTranslator->translator($lang);
    }
    public function getCategory(int $id){
        return $this->ShowRootCategoriesHandler->getCategory($id);
    }
    public function getRootCategory(int $rootCategoryId = 0){
        return $this->ShowRootCategoriesHandler->getRootCategoryList($rootCategoryId);
    }
    
    public function getSubCategories(int $parentCategoryId){
        return $this->ShowRootCategoriesHandler->getSubCategoryList($parentCategoryId);
    }
    
    public function updateCategory(UpdateCategoryDTO $updateCategoryDTO){
        $this->updateCategoryHandler->handler($updateCategoryDTO);
    }
}
