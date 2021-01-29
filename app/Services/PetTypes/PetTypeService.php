<?php


namespace App\Services\PetTypes;


use App\Services\PetTypes\Repositories\PetTypeRepository;
use Illuminate\Database\Eloquent\Collection;

class PetTypeService
{

    /**
     * @var PetTypeRepository
     */
    private $repository;

    public function __construct(
        PetTypeRepository $repository
    )
    {
        $this->repository = $repository;
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }
}