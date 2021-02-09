<?php


namespace App\Models;


class ModBase extends BaseModel
{
    protected $connection = 'qsiq';

    protected $table = 'mod_base';

    protected $primaryKey = 'lead_id';


    public function base()
    {
        return $this->belongsTo(ModBases::class,'base_id','base_id');
    }

    public function status()
    {
        return $this->belongsTo(ModQueueStatus::class,'operator_status','id');
    }

    public function records()
    {
        return $this->hasOne(ModRecords::class,'uniqueid','uniqueid');
    }

    public function user()
    {
        return $this->hasOne(ModUsers::class, 'phone_id', 'operator_id');
    }

}
