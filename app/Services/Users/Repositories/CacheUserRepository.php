<?php


namespace App\Services\Users\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Support\Cache\CacheHelper;

class CacheUserRepository extends UserRepository
{

    public function findById(int $id): User
    {
        return CacheHelper::remember(User::query(), class_basename(User::class), $id)->findOrFail($id);
    }

    /**
     * @return User[]|Builder[]|Collection|mixed
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

    public function create(array $data): User
    {
        $data = collect($data)->whereNotNull()->all();
        $result = User::create($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(User $user)
    {
        $result = $user->delete();

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    public function update(User $user, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();
        $result = $user->update($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }
}