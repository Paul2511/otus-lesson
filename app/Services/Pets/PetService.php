<?php


namespace App\Services\Pets;
use App\Jobs\Pet\PetDeleteJob;
use App\Models\Pet;
use App\Services\Pets\Repositories\PetRepository;
use App\Models\User;
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

    /**
     * @return Pet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getUserPets(User $user)
    {
        $clientId = $user->client->id;
        return $this->petRepository->getPets($clientId, true);
    }

    public function deletePet(Pet $pet): void
    {
        PetDeleteJob::dispatch($pet);
    }

}