<?php


namespace App\Services\Users;

use App\Services\Users\Repository\EloquentUserRepository;
use Illuminate\Database\Eloquent\Model;

class UsersServices
{

    private EloquentUserRepository $eloquentUserRepository;

    public function __construct(
        EloquentUserRepository $eloquentUserRepository
    )
    {
        $this->eloquentUserRepository = $eloquentUserRepository;

    }

    public function getUsers()
    {
        return $this->eloquentUserRepository->search();
    }

    public function storeUser(array $data): Model
    {
        return $this->eloquentUserRepository->create($data);
    }

    public function deleteUser(int $id)
    {
        return $this->eloquentUserRepository->delete($id);
    }

    public function updateUser(array $data, int $id)
    {
        return $this->eloquentUserRepository->update($id, $data);
    }

    public function findUser(int $id)
    {
        return $this->eloquentUserRepository->findOrFail($id);
    }


}
