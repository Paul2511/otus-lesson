<?php


namespace App\Services\Pets\Repositories;

use App\Helpers\CacheHelper;
use App\Models\Pet;

class PetRepository
{
    public function findPet(int $petId, ?bool $fromCache=false): Pet
    {
        return $fromCache ?
            CacheHelper::remember(Pet::query(), Pet::$modelName, $petId)->findOrFail($petId) :
            Pet::findOrFail($petId);
    }

    /**
     * @return Pet[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getPets(?int $userId = null, ?bool $fromCache=false)
    {
        $query = Pet::query();
        if ($userId) {
            $query->where(['client_id'=>$userId]);
        }

        return $fromCache ?
            CacheHelper::remember($query, Pet::$modelName . 's', $userId)->get() :
            $query->get();
    }

    /**
     * @param Pet $pet
     * @return bool|null
     * @throws \Exception
     */
    public function deletePet(Pet $pet)
    {
        //Использую для тестирования логов в слэке:
        //throw new \Exception('Тест логгирования ошибки');

        return $pet->delete();
    }
}