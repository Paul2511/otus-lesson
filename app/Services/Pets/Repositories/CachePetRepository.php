<?php


namespace App\Services\Pets\Repositories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Support\Cache\CacheHelper;

class CachePetRepository extends PetRepository
{

    public function findById(int $id): Pet
    {
        return CacheHelper::remember(Pet::query(), class_basename(Pet::class), $id)->findOrFail($id);
    }

    /**
     * @return Pet[]|Builder[]|Collection|mixed
     */
    public function get()
    {
        $query = $this->query;
        if ($this->isSearch) {
            return $query->get();
        }

        $key = CacheHelper::getKey($this->tag) . ':'.$this->request->getHash();
        $ttl = CacheHelper::getTTL($this->tag);

        return \Cache::tags($this->tag)->remember($key, $ttl, function () use ($query){
            return $query->get();
        });
    }

    /**
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|mixed
     */
    public function paginate(int $perPage)
    {
        $query = $this->query;
        if ($this->isSearch) {
            return $query->paginate($perPage);
        }

        $key = CacheHelper::getKey($this->tag) . ':'.$this->request->getHash();
        $ttl = CacheHelper::getTTL($this->tag);

        return \Cache::tags($this->tag)->remember($key, $ttl, function () use ($query, $perPage){
            return $query->paginate($perPage);
        });
    }

    public function create(array $data): Pet
    {
        $data = collect($data)->whereNotNull()->all();
        $result = Pet::create($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Pet $pet)
    {
        $result = $pet->delete();

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    public function update(Pet $pet, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();
        $result = $pet->update($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }
}