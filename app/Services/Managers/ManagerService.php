<?php


namespace App\Services\Managers;

use App\Exceptions\Manager\ManagerCreateException;
use App\Models\Manager;
use App\Services\Managers\DTO\ManagerCreateData;
use App\Services\Managers\Repositories\ManagerRepository;

class ManagerService
{
    /**
     * @var ManagerRepository
     */
    private $managerRepository;

    public function __construct(ManagerRepository $managerRepository)
    {
        $this->managerRepository = $managerRepository;
    }

    /**
     * @throws ManagerCreateException
     */
    public function create(ManagerCreateData $managerCreateData): Manager
    {
        $data = $managerCreateData->toArray();
        try {
            $manager = $this->managerRepository->create($data);
            return $manager;
        } catch (\Throwable $e) {
            throw new ManagerCreateException($e->getMessage());
        }
    }
}