<?php


namespace App\Services\Specializations\Repositories;

use App\Models\Specialization;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Support\Cache\CacheHelper;
class CacheSpecializationRepository extends SpecializationRepository
{

    public function findById(int $id): Specialization
    {
        return CacheHelper::remember(Specialization::query(), class_basename(Specialization::class), $id)->findOrFail($id);
    }

    /**
     * @return Specialization[]|Builder[]|Collection|mixed
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

    public function create(array $data): Specialization
    {
        $data = collect($data)->whereNotNull()->all();
        $result = Specialization::create($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Specialization $specialization)
    {
        $result = $specialization->delete();

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    public function update(Specialization $specialization, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();
        $result = $specialization->update($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }
}