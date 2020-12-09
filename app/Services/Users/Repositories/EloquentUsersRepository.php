<?php

namespace App\Services\Users\Repositories;

use App\Models\User;
use App\Http\Controllers\Admin\AdminBaseController;
use \Illuminate\Pagination\LengthAwarePaginator;

class EloquentUsersRepository {
    
    /** 
     * 
     * @return \App\Services\Users\Repositories\LengthAwarePaginator
     */
    
    public function search(): LengthAwarePaginator
    {
        return User::paginate();
    }
    
    public function getUserList():LengthAwarePaginator {
        return User::paginate(AdminBaseController::DEFAULT_MODEL_PER_PAGE);
    }
    
    public function getUser(int $id):User
    {
        return User::where('id', $id)->first();
    }
    
    public function createFromArray(array $data): Users{
        return User::create($data);
    }
    
    public function updateFromArray(array $data): Users{
        return User::update($data);
    }
}
