<?php


namespace App\Models;


class ModBases extends BaseModel
{
    protected $connection = 'qsiq';

    protected $table = 'mod_bases';

    protected $primaryKey = 'base_id';


    public function leads()
    {
        return $this->hasMany(ModBase::class, 'base_id','base_id');
    }
}
