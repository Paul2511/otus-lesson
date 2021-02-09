<?php


namespace App\Models;


class ModOffices extends BaseModel
{
    protected $connection = 'qsiq';

    protected $table = 'mod_officea';

    protected $primaryKey = 'id';

    public function users()
    {
        return $this->hasManyThrough(ModUsers::class, ModDepartments::class,'office_id','department_id','id');
    }
}
