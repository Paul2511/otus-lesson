<?php


namespace App\Services\Permissions\Handlers;


use Illuminate\Database\Eloquent\Model;

class UpdatePermissionHandler
{
    public function updatePermission(array $data, Model $model)
    {
        $model->update($data);
        return $model;
    }

}
