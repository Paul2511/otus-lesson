<?php

namespace App\Http\Controllers\Admin\Resources;

use App\Http\Controllers\Controller;
use App\Services\Resources\Repositories\EloquentResourceRepository;
use App\Services\Resources\ResourcesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminResourcesController extends Controller
{
    private ResourcesService $resourcesService;

    public function __construct(
        ResourcesService $resourcesService
    ) {
        $this->resourcesService = $resourcesService;
    }

    public function __invoke(): JsonResponse
    {
        $resources = $this->resourcesService->getList();
        return response()->json(['resources' => $resources]);
    }

}
