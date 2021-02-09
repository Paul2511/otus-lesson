<?php


namespace App\Models;


class ModGroups extends BaseModel
{
    protected $connection = 'qsiq';

    protected $table = 'mod_groups';

    protected $primaryKey = 'id';

    public function users()
    {
        return $this->hasMany(ModUsers::class, 'group_id', 'id');
    }
}
