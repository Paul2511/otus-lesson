<?php


namespace App\Services\Pets\Repositories;

use App\Models\Pet;
class PetRepository
{

    public function getPet(int $id): Pet
    {
        return Pet::findOrFail($id);
    }

    /**
     * @return Pet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPets(int $userId = null)
    {
        $query = Pet::query();
        if ($userId) {
            $query->where(['client_id'=>$userId]);
        }
        return $query->get();
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function deletePet(int $id)
    {
        $pet = $this->getPet($id);

        return $pet->delete();
    }
}