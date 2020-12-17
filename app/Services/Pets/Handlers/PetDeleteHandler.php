<?php


namespace App\Services\Pets\Handlers;

use App\Services\Pets\Repositories\PetRepository;
use App\Models\Pet;
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
            return $this->petRepository->deletePet($pet);
        } catch (\Exception $e) {
            //todo репорт ошибки
            return false;
        }

    }
}