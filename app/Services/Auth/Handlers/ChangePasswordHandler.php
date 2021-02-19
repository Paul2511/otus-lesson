<?php


namespace App\Services\Auth\Handlers;


use App\Exceptions\Auth\ChangePasswordException;
use App\Models\User;
use App\Services\Users\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
class ChangePasswordHandler
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->repository = $repository;
    }

    /**
     * @throws ChangePasswordException
     */
    public function handle(User $user, string $password)
    {
        $passwordHash = Hash::make($password);

        try {
            $this->repository->update($user, ['password'=>$passwordHash]);
        } catch (\Throwable $e) {
            throw new ChangePasswordException($e->getMessage());
        }

    }
}