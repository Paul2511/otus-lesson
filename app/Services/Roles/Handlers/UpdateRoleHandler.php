<?php


namespace App\Services\Roles\Handlers;


use Illuminate\Database\Eloquent\Model;

class UpdateRoleHandler
{
    public function updateRole(array $data, Model $model)
    {
        $model->update($data);
        return $model;
    }

}
