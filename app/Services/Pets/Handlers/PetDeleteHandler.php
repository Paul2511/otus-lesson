<?php


namespace App\Services\Pets\Handlers;

use App\Services\Pets\Repositories\PetRepository;
use App\Models\Pet;
use App\Helpers\LogHelper;
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
    public function handler(Pet $pet)
    {
        try {
            $result = $this->petRepository->deletePet($pet);

            LogHelper::pet("Удален питомец #{$pet->id}", [
                'userId'=>auth()->user()->getAuthIdentifier()
            ]);

            return $result;
        } catch (\Exception $e) {

            LogHelper::slack("Ошибка удаления питомца #{$pet->id}", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage()
            ]);

            return false;
        }

    }
}