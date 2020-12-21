<?php


namespace App\Services\Resources;


use App\Services\Resources\Repositories\EloquentResourceRepository;
use Illuminate\Database\Eloquent\Collection;

class ResourcesService
{
    private EloquentResourceRepository $eloquentResourceRepository;

    public function __construct(
        EloquentResourceRepository $eloquentResourceRepository
    ) {
        $this->eloquentResourceRepository = $eloquentResourceRepository;
    }

    public function getList(): Collection
    {
        return $this->eloquentResourceRepository->getList();
    }

}
