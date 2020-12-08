<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Services\Resources\Repositories\EloquentResourceRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminResourcesController extends Controller
{
    private EloquentResourceRepository $eloquentResourceRepository;
    public function __construct(
        EloquentResourceRepository $eloquentResourceRepository
    )
    {
        $this->eloquentResourceRepository = $eloquentResourceRepository;
    }


    public function __invoke():JsonResponse
    {
        $resources = $this->eloquentResourceRepository->getList();
        return response()->json(['resources'=>$resources]);
    }

}
