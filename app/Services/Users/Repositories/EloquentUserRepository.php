<?php


namespace App\Services\Users\Repositories;


use App\Models\Resource;
use App\Models\User;
use App\Models\ProjectUser;
use Illuminate\Database\Eloquent\Collection;

class EloquentUserRepository
{
    /**
     * @param  int  $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getUserWithResourceRelation(int $id) : Collection
    {
       return $this->findById($id, [
           'resources'
       ]);
    }

    public function getResourceIds(int $id): array
    {
        $resources = [];
        $resources_user = $this->findById($id, [
         'resource_user'
        ])->resource_user->toArray();

        return $resources;
    }

    public function getList(array $with = []): Collection
    {
        $query = User::query();
        $query->with($with);
        return $query->get();
    }

    public function getByNameStart(string $name,int $limit,int $offset=0): Collection
    {
        return User::where('full_name','LIKE', $name. '%')
            ->take($limit)
            ->skip($offset)
            ->get();
    }

    public function findByPhone(string $phone): User
    {
        return User::where('phone',$phone)->first();
    }

    /**
     * @param  int  $id
     * @param  array  $with
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findById(int $id ,array $with = [])
    {
        $query = User::with($with);
        return $query->findOrFail($id);
    }

    public function getProjects(int $id): array
    {
        $projects = [];
        $project_user = $this->findById($id, [
            'project_user'
        ])->project_user->toArray();
        foreach ($project_user as $res)
        {
            $projects[] = $res['project'];
        }
        return $projects;
    }

    public function createUser(array $data): User
    {
        $user = User::create($data);
        return $user;
    }


    public function attachResourcesToUser($user, $data): User
    {
        if (!empty($data['resources'])) {
            $user->resources()->sync($data['resources']);
        }
        return $user;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function updateUserById(int $id, array $data)
    {
        $user = $this->findById($id);
        $user->fill($data)->save();

        return $user;
    }

    public function attachProjectsToUser(User $user, array $data):User
    {
        $user->project_user()->delete();

        if (!empty($data['projects'])) {
            foreach ($data['projects'] as $project) {
                $user->project_user()->saveMany([
                    new ProjectUser(['project' => $project]),
                ]);
            }
        }
        return $user;
    }

    public function activeUser(int $id, int $is_active)
    {
        $user = $this->findById($id);
        $user->is_active = $is_active;
        return $user->save();
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email',$email)->first();
    }

    public function checkPermission(User $user, int $resource_id): bool
    {
        return $user->hasPermission($resource_id);
    }
}
