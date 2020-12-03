<?php


namespace App\Services\Handlers;


use App\Http\Controllers\Admin\AdminBaseController;
use App\Models\User;
use App\Services\Users\Repositories\EloquentUserRepository;


class PaginateUsersHandler
{
    /**
     * @var EloquentUserRepository
     */
    private $eloquentUserRepository;


    public function __construct(
        EloquentUserRepository $eloquentUserRepository
    )
    {
        $this->eloquentUserRepository = $eloquentUserRepository;
    }

    public function handle(int $perPage)
    {
        $users = $this->eloquentUserRepository->searchWithCompanyRoleRelation($perPage);
        return $users;
    }
}