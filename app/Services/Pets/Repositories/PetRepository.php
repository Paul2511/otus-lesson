<?php


namespace App\Services\Pets\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Support\Cache\CacheHelper;
use App\Models\Pet;

class PetRepository
{
    public function findPet(int $petId, ?bool $fromCache=false): Pet
    {
        return $fromCache ?
            CacheHelper::remember(Pet::query(), class_basename(Pet::class), $petId)->findOrFail($petId) :
            Pet::findOrFail($petId);
    }

    public function getPets(?int $clientId = null, ?bool $fromCache=false): Collection
    {
        $query = Pet::query();
        if ($clientId) {
            $query->where(['client_id'=>$clientId]);
        }

        return $fromCache ?
            CacheHelper::remember($query, \Str::plural(class_basename(Pet::class)), $clientId)->get() :
            $query->get();
    }

    public function updatePet(Pet $pet, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();

        return $pet->update($data);
    }

    public function createPet(array $data): Pet
    {
        $data = collect($data)->whereNotNull()->all();
        return Pet::create($data);
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