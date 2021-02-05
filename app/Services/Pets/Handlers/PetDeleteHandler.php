<?php


namespace App\Services\Pets\Handlers;

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
     * @param Pet $pet
     * @return bool|null
     */
    public function handle(Pet $pet, ?array $logData)
    {
        try {
            $result = $this->petRepository->deletePet($pet);

            LogHelper::pet("Удален питомец #{$pet->id}", $logData);

            return $result;
        } catch (\Exception $e) {

            $logData['error'] = $e->getMessage();

            LogHelper::slack("Ошибка удаления питомца #{$pet->id}", $logData);

            return false;
        }
    }
}