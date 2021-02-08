<?php


namespace App\Services\Specializations\Handlers;


use App\Exceptions\Specialization\SpecializationDeleteException;
use App\Models\Specialization;
use App\Services\Specializations\Repositories\SpecializationRepository;

class SpecializationDeleteHandler
{
    /**
     * @var SpecializationRepository
     */
    private $repository;

    public function __construct(SpecializationRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws SpecializationDeleteException
     */
    public function handle(Specialization $specialization): void
    {
        try {
            $this->repository->delete($specialization);
        } catch (\Throwable $e) {
            throw new SpecializationDeleteException($e->getMessage());
        }
    }
}