<?php


namespace App\Services\PetTypes\Repositories;

use App\Models\PetType;
use Illuminate\Database\Eloquent\Collection;
class EloquentPetTypeRepository extends PetTypeRepository
{

    public function findById(int $id): PetType
    {
        return PetType::findOrFail($id);
    }

    /**
     * @return PetType[]|\Illuminate\Database\Eloquent\Builder[]|Collection
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

    public function create(array $data): PetType
    {
        $data = collect($data)->whereNotNull()->all();

        return PetType::create($data);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(PetType $petType)
    {
        return $petType->delete();
    }

    public function update(PetType $petType, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();

        return $petType->update($data);
    }
}