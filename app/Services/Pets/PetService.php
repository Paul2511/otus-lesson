<?php


namespace App\Services\Pets;
use App\Models\Pet;
use App\Services\BaseService;
use App\Services\Pets\Repositories\PetRepository;
use App\Services\Pets\Handlers\PetDeleteHandler;
use App\Services\Pets\Helpers\PetLabelsHelper;
class PetService extends BaseService
{
    /**
     * @var PetRepository
     */
    private $petRepository;
    /**
     * @var PetDeleteHandler
     */
    private $petDeleteHandler;
    /**
     * @var PetLabelsHelper
     */
    private $petLabelsHelper;

    public function __construct(
        PetRepository $petRepository,
        PetDeleteHandler $petDeleteHandler,
        PetLabelsHelper $petLabelsHelper
    )
    {
        $this->petRepository = $petRepository;
        $this->petDeleteHandler = $petDeleteHandler;
        $this->petLabelsHelper = $petLabelsHelper;
    }

    public function getUserPets(int $userId): array
    {
        $pets = $this->petRepository->getPets($userId, true);
        $result = $pets->map(function (Pet $pet){
            return $this->petLabelsHelper->toArray($pet);
        });

        return [
            'pets' => $result,
            'success' => true
        ];
    }

    public function deletePet(Pet $pet): array
    {
        $result = $this->petDeleteHandler->handler($pet);
        return ['success'=>$result];
    }

}