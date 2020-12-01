<?php


namespace App\Services\Users\Handlers;


use Illuminate\Database\Eloquent\Model;

class DeleteUserHandler
{
    public function deleteUser(Model $model)
    {
        return $model->delete();
    }

}
