<?php


namespace App\Services\Users\Handlers;


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
     */
    public function handle(array $data): void
    {
        $data['password'] = Hash::make(Str::random(12));
        $this->repository->createByArray($data);
    }
}
