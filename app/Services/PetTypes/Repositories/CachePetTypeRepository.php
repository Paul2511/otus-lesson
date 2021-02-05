<?php


namespace App\Services\PetTypes\Repositories;

use App\Models\Pet;
use App\Models\PetType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Support\Cache\CacheHelper;
class CachePetTypeRepository extends PetTypeRepository
{

    public function findById(int $id): PetType
    {
        return CacheHelper::remember(PetType::query(), class_basename(PetType::class), $id)->findOrFail($id);
    }

    /**
     * @return PetType[]|Builder[]|Collection|mixed
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

    public function create(array $data): PetType
    {
        $data = collect($data)->whereNotNull()->all();
        $result = PetType::create($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(PetType $petType)
    {
        $result = $petType->delete();

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    public function update(PetType $petType, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();
        $result = $petType->update($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }
}