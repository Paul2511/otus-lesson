<?php


namespace App\Services\Pets\Repositories;

use App\Models\Pet;
class PetRepository
{

    public function findPet(int $id): Pet
    {
        return Pet::findOrFail($id);
    }

    /**
     * @return Pet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPets(?int $userId = null)
    {
        $query = Pet::query();
        if ($userId) {
            $query->where(['client_id'=>$userId]);
        }
        return $query->get();
    }

    /**
     * @param Pet $pet
     * @return bool|null
     * @throws \Exception
     */
    public function deletePet(Pet $pet)
    {
        return $pet->delete();
    }
}