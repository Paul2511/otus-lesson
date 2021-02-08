<?php


namespace App\Services\Specializations\Repositories;

use App\Models\Specialization;
use Illuminate\Database\Eloquent\Collection;

class EloquentSpecializationRepository extends SpecializationRepository
{

    public function findById(int $id): Specialization
    {
        return Specialization::findOrFail($id);
    }

    /**
     * @return Specialization[]|\Illuminate\Database\Eloquent\Builder[]|Collection
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

    public function create(array $data): Specialization
    {
        $data = collect($data)->whereNotNull()->all();

        return Specialization::create($data);
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Specialization $specialization)
    {
        return $specialization->delete();
    }

    public function update(Specialization $specialization, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();

        return $specialization->update($data);
    }
}