<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\Category;
use App\Http\Requests\Admin\AdminCategoriesStoreRequest;
use App\Http\Requests\Admin\AdminCategoriesUpdateRequest;
use Illuminate\Support\Facades\View;
use App\Services\Categories\CategoriesService;
use App\Services\Routes\Providers\Admin\AdminRoutes;

class AdminCategoriesController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private CategoriesService $categoriesService;
    
    public function __construct(
            CategoriesService $categoriesService
            ){
        $this->categoriesService = $categoriesService;
    }
    public function index()
    {
        $categories = $this->categoriesService->getRootCategory();
        view::share([
            'categories' => $categories,
        ]);
        
        return view('admin.categories.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoriesService->getRootCategory();
        view::share([
            'categories' => $categories,
        ]);
        
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminCategoriesStoreRequest $request)
    {
        return $this->categoriesService->createCategory($request->generateCreateCategoryDTO());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $categories
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $category = $this->categoriesService->getCategory($id);
        $subcategories = $this->categoriesService->getSubCategories($id);
        view::share([
            'category' => $category,
            'categories' => $subcategories,
        ]);
        return view('admin.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Categories\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $category = $this->categoriesService->getCategory($id);
        $subcategories = $this->categoriesService->getSubCategories($id);
        view::share([
            'category'=>$category,
            'categories'=>$subcategories
        ]);
        return view('admin.categories.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\AdminCategoriesStoreRequest  $request
     * @param  \App\Models\Admin\Categories\Category  $categories
     * @return \Illuminate\Http\Response
     */
    public function update(AdminCategoriesUpdateRequest $request)
    {
        $this->categoriesService->updateCategory($request->generateUpdateCategoryDTO());
        
        return redirect(AdminRoutes::ADMIN_CATEGORIES_INDEX);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Categories\Categories  $categories
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categories $categories)
    {
        //
    }
    
    private function getStatuses(){
        return $this->categoriesService->translateStatuses(App::getLocale());
    }
}
