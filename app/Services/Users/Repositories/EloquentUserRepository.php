<?php


namespace App\Services\Users\Repositories;


use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;


class EloquentUserRepository
{
    public function searchWithCompanyRoleRelation(int $perPage): LengthAwarePaginator
    {
        return $this->search($perPage, [
            'role', 'companies' => function ($q) {
            $q->remember(config('cache.query_cache_lifetime'));
        }
        ]);
    }

    public function search(int $perPage, array $with = []): LengthAwarePaginator
    {
        $qb = User::query();
        $qb->with($with)
            ->remember(config('cache.query_cache_lifetime'));

        return $qb->paginate($perPage);
    }

    public function findUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function updateUserById(int $id, $request): User
    {
        $user = $this->findById($id);
        $user->fill($request)->save();

        return $user;
    }

    public function findById(int $id): User
    {
        return User::findOrFail($id);
    }

    public function findUserByIdWithRelations(int $id, array $with = []): User
    {
        $qb = User::query();
        $qb->with($with);

        return $qb->findOrFail($id);
    }

    public function attachRoleToUser(array $data, $user): User
    {
        $roleId = $this->findRoleByName($data['role']);
        $user->role()->associate($roleId)->save();

        return $user;
    }

    public function attachCompanyToUser(array $data, $user): User
    {
        $company_id = Company::whereInn($data['inn'])->get('id');
        $user->companies()->attach($company_id, ['user_id' => $user->id]);

        return $user;
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return $user;
    }

    public function deleteUserById(int $id): User
    {
        $user = User::findOrFail($id);
        $user->delete();

        return $user;
    }

    public function findRoleByName(int $roleName)
    {
       $roleId = Role::whereName($roleName)->firstOrFail('id');

       return $roleId;
    }

    public function getUserIds(): array
    {
        return User::where('id' ,'>' ,0)->pluck('id')->toArray();
    }


}