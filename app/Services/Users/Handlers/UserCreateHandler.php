<?php


namespace App\Services\Users\Handlers;


use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserCreateHandler
{
    /**
     * @var EloquentUserRepository
     */
    private $repository;

    public function __construct(EloquentUserRepository $repository)
    {

        $this->repository = $repository;
    }


    /**
     * @param array $data
     * @return User|null
     */
    public function handle(array $data): ?User
    {
        $data['password'] = ($data['password']) ?: Hash::make(Str::random(12));
        return $this->repository->createByArray($data);
    }
}
