<?php


namespace App\Services\Pets\Handlers;

use App\Services\Pets\Repositories\PetRepository;
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
     * @param int $id
     * @return bool|null
     */
    public function handler(int $id)
    {
        $pet = $this->petRepository->findPet($id);
        try {
            return $this->petRepository->deletePet($pet);
        } catch (\Exception $e) {
            //todo репорт ошибки
            return false;
        }

    }
}