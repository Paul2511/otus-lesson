<?php

namespace App\Services\Categories\Repositories;

use App\Models\Category;
use App\Http\Controllers\Admin\AdminBaseController;
use \Illuminate\Pagination\LengthAwarePaginator;

class EloquentCategoriesRepository {
    
    /** 
     * 
     * @return \App\Services\Categories\Repositories\LengthAwarePaginator
     */
    
    public function search(): LengthAwarePaginator
    {
        return Category::paginate();
    }
    
    public function getRootCategories(int $rootCategoryId):LengthAwarePaginator
    {
        return Category::where('parent_id', $rootCategoryId)->paginate(AdminBaseController::DEFAULT_MODEL_PER_PAGE);
    }
    public function getSubCategories(int $parent_id){
         return Category::where('parent_id', $parent_id)->paginate(AdminBaseController::DEFAULT_MODEL_PER_PAGE);
    }
    
    public function getList(int $id):Collection {
        return Category::where('id', $id)->get();
    }
    
    public function getCategory(int $id):Category
    {
        return Category::where('id', $id)->first();
    }
    
    public function createFromArray(array $data): Categories{
        return Category::create($data);
    }
    
    public function updateFromArray(array $data): Categories{
        return Category::update($data);
    }
}
