<?php


namespace App\Services\Roles\Handlers;


use Illuminate\Database\Eloquent\Model;

class DeleteRoleHandler
{
    public function deleteRole(Model $model)
    {
        return $model->delete();
    }

}
