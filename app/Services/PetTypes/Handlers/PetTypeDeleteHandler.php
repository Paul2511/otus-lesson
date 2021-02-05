<?php


namespace App\Services\PetTypes\Handlers;


use App\Exceptions\PetType\PetTypeDeleteException;
use App\Models\PetType;
use App\Services\PetTypes\Repositories\PetTypeRepository;

class PetTypeDeleteHandler
{
    /**
     * @var PetTypeRepository
     */
    private $repository;

    public function __construct(PetTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws PetTypeDeleteException
     */
    public function handle(PetType $petType): void
    {
        try {
            $this->repository->delete($petType);
        } catch (\Throwable $e) {
            throw new PetTypeDeleteException($e->getMessage());
        }
    }
}