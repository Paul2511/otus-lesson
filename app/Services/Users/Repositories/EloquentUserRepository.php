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
            'roles', 'companies'
        ]);
    }

    public function search(int $perPage, array $with = []): LengthAwarePaginator
    {
        $qb = User::query();
        $qb->with($with);

        return $qb->paginate($perPage);
    }

    public function findUserByEmail(string $email): User
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
        $role_id = Role::whereName($data['role'])->get('id');
        $user->roles()->sync($role_id);

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

    public function deleteUserById(int $id): int
    {
        return User::destroy($id);
    }


}