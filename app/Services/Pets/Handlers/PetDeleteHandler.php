<?php


namespace App\Services\Pets\Handlers;

use App\Exceptions\Pet\PetDeleteException;
use App\Services\Pets\Repositories\PetRepository;
use App\Models\Pet;
use Support\Log\LogHelper;
class PetDeleteHandler
{
    /**
     * @var PetRepository
     */
    private $petRepository;

    public function __construct(
        PetRepository $petRepository
    )
    {
        $this->petRepository = $petRepository;
    }

    /**
     * @throws PetDeleteException
     */
    public function handle(Pet $pet, ?array $logData = []): bool
    {
        try {
            $result = $this->petRepository->delete($pet);

            LogHelper::pet("Удален питомец #{$pet->id}", $logData);

            return $result;
        } catch (\Exception $e) {
            throw new PetDeleteException($e->getMessage());
        }
    }
}