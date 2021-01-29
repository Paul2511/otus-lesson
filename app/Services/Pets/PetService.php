<?php


namespace App\Services\Pets;
use App\Exceptions\Client\ClientNotFoundException;
use App\Exceptions\Pet\PetCreateException;
use App\Exceptions\Pet\PetUpdateException;
use App\Jobs\Pet\PetDeleteJob;
use App\Models\Pet;
use App\Services\Pets\DTO\PetCreateData;
use App\Services\Pets\DTO\PetUpdateData;
use App\Services\Pets\Repositories\PetRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Support\Log\LogHelper;

class PetService
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

    public function findPet(int $petId): Pet
    {
        return $this->petRepository->findPet($petId, true);
    }

    /**
     * @throws ClientNotFoundException
     */
    public function getUserPets(?User $user = null): Collection
    {
        $clientId = null;

        if ($user) {
            if (!$user->client) {
                throw new ClientNotFoundException();
            }
            $clientId = $user->client->id;
        }

        return $this->petRepository->getPets($clientId, true);
    }

    /**
     * @throws PetUpdateException
     */
    public function updatePet(Pet $pet, PetUpdateData $updateData): Pet
    {
        \DB::beginTransaction();

        $data = $updateData->all();
        try {

            $result = $this->petRepository->updatePet($pet, $data);

            if (!$result) {
                throw new PetUpdateException();
            }

            \DB::commit();

            $pet->refresh();
            return $pet;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка обновления питомца #{$pet->id}", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'petData'=>$data
            ]);
            throw new PetUpdateException($e->getMessage());
        }
    }

    /**
     * @throws ClientNotFoundException
     * @throws PetCreateException
     */
    public function createPet(PetCreateData $createData, ?User $user = null): Pet
    {
        if (!$user) {
            /** @var User $user */
            $user = auth()->user();
        }

        if (!$user->client) {
            throw new ClientNotFoundException();
        }
        $createData->client_id = $user->client->id;

        $data = $createData->toArray();

        try {
            $pet = $this->petRepository->createPet($data);

            return $pet;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка создания питомца", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'petData'=>$data
            ]);
            throw new PetCreateException($e->getMessage());
        }
    }

    public function deletePet(Pet $pet): void
    {
        PetDeleteJob::dispatch($pet);
    }

}