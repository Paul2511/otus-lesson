<?php


namespace App\Services\Permissions\Handlers;


use Illuminate\Database\Eloquent\Model;

class DeletePermissionHandler
{
    public function deletePermission(Model $model)
    {
        return $model->delete();
    }

}
