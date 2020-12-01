<?php


namespace App\Services\Users\Handlers;

use Illuminate\Database\Eloquent\Model;

class UpdateUserHandler
{
    public function updateUser(array $data, Model $model)
    {
        $model->update($data);
        return $model;
    }

}
