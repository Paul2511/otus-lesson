<?php


namespace App\Services\Pets;
use App\Services\BaseService;
use App\Services\Pets\Repositories\PetRepository;
class PetService extends BaseService
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

    public function getPets(int $userId = null): array
    {
        $result = $this->petRepository->getPets($userId);

        return ['pets'=>$result];
    }

    /**
     * @param int $id
     * @return array
     * @throws \Exception
     */
    public function deletePet(int $id)
    {
        $result = $this->petRepository->deletePet($id);
        return ['success'=>$result];
    }
}