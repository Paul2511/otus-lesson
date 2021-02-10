<?php


namespace App\Services\Pets\Repositories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Collection;
class EloquentPetRepository extends PetRepository
{

    public function findById(int $id): Pet
    {
        return Pet::findOrFail($id);
    }

    /**
     * @return Pet[]|\Illuminate\Database\Eloquent\Builder[]|Collection
     */
    public function get()
    {
        return $this->query->get();
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(int $perPage)
    {
        return $this->query->paginate($perPage);
    }

    public function create(array $data): Pet
    {
        $data = collect($data)->whereNotNull()->all();

        return Pet::create($data);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Pet $pet)
    {
        return $pet->delete();
    }

    public function update(Pet $pet, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();

        return $pet->update($data);
    }
}