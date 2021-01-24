<?php


namespace App\Services\Specialists;

use App\Exceptions\Specialist\SpecialistCreateException;
use App\Models\Specialist;
use App\Services\Specialists\DTO\SpecialistCreateData;
use App\Services\Specialists\Repositories\SpecialistRepository;

class SpecialistService
{

    /**
     * @var SpecialistRepository
     */
    private $specialistRepository;

    public function __construct(SpecialistRepository $specialistRepository)
    {
        $this->specialistRepository = $specialistRepository;
    }

    /**
     * @throws SpecialistCreateException
     */
    public function create(SpecialistCreateData $specialistCreateData): Specialist
    {
        $data = $specialistCreateData->toArray();
        try {
            $specialist = $this->specialistRepository->create($data);
            return $specialist;
        } catch (\Throwable $e) {
            throw new SpecialistCreateException($e->getMessage());
        }
    }
}