<?php


namespace App\Services\Pets;
use App\Exceptions\Client\ClientNotFoundException;
use App\Exceptions\Pet\PetCreateException;
use App\Exceptions\Pet\PetDeleteException;
use App\Exceptions\Pet\PetUpdateException;
use App\Jobs\Pet\PetDeleteJob;
use App\Models\Pet;
use App\Services\Pets\DTO\PetCreateData;
use App\Services\Pets\DTO\PetUpdateData;
use App\Services\Pets\Handlers\PetDeleteHandler;
use App\Services\Pets\Repositories\PetRepository;
use App\Models\User;
use Support\Log\LogHelper;

class PetService
{
    /**
     * @var PetRepository
     */
    private $repository;
    /**
     * @var PetDeleteHandler
     */
    private $deleteHandler;


    public function __construct(
        PetRepository $petRepository,
        PetDeleteHandler $deleteHandler
    )
    {
        $this->repository = $petRepository;
        $this->deleteHandler = $deleteHandler;
    }

    public function findPet(int $petId): Pet
    {
        return $this->repository->findById($petId);
    }

    /**
     * @return Pet[]|array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     * @throws ClientNotFoundException
     */
    public function getPets(?User $user = null, ?int $perPage = null, ?bool $withRequest = false)
    {
        $repository = $this->repository;

        if ($withRequest) {
            $repository = $repository->withRequest();
        }

        $clientId = null;

        if ($user) {
            if (!$user->client) {
                throw new ClientNotFoundException();
            }
            $clientId = $user->client->id;
            $repository = $repository->filterByClient($clientId);
        }

        $result = $perPage ? $repository->paginate($perPage) : $repository->get();

        return $result ?? [];
    }

    /**
     * @throws PetUpdateException
     */
    public function updatePet(Pet $pet, PetUpdateData $updateData): Pet
    {
        \DB::beginTransaction();

        $data = $updateData->all();
        try {

            $result = $this->repository->update($pet, $data);

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
            $pet = $this->repository->create($data);

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

    /**
     * @throws PetDeleteException
     */
    public function deletePet(Pet $pet): void
    {
        //todo PetDeleteJob::dispatch($pet);

        \DB::beginTransaction();
        try {
            $this->deleteHandler->handle($pet);
            \DB::commit();
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка удаления питомца", [
                'userId' => auth()->user()->getAuthIdentifier(),
                'error' => $e->getMessage(),
                'petId' => $pet->id
            ]);
            throw new PetDeleteException($e->getMessage());
        }
    }

}