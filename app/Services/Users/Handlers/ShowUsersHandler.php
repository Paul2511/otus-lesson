<?php

namespace App\Services\Users\Handlers;

use App\Services\Users\Repositories\EloquentUsersRepository;

class ShowUsersHandler {
    
    private EloquentUsersRepository $EloquentUsersRepository;
    
    public function __construct(EloquentUsersRepository $EloquentUsersRepository) {
        $this->EloquentUsersRepository = $EloquentUsersRepository;
    }
    public function getUser(int $id){
        return $this->EloquentUsersRepository->getUser($id);
    }
    public function getUsersList(){
        return $this->EloquentUsersRepository->getUserList();
    }
}
