<?php


namespace App\Models;


class ModUsers extends BaseModel
{
    protected $connection = 'qsiq';

    protected $table = 'mod_users';

    protected $primaryKey = 'id';


    public function group()
    {
        return $this->hasOne(ModGroups::class, 'id', 'group_id');
    }

}
