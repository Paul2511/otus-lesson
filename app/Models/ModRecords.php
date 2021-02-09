<?php


namespace App\Models;


use Illuminate\Support\Facades\DB;

class ModRecords extends BaseModel
{
    protected $connection = 'qsiq';
    protected $table = 'mod_records';
    protected $primaryKey = 'uniqueid';

    public function status()
    {
        return $this->belongsTo(ModQueueStatus::class,'operator_status','id');
    }

    public function scenario_alias()
    {
        return $this->hasMany(ModScenarioAliases::class,'scenario_id','scenario_id')
            ->where('type','=','0');
    }

    public function scenario_results_value()
    {
        return $this->hasMany(ModScenarioResultsValues::class,'result_id','result_id');
    }
    public function user()
    {
        return $this->hasOne(ModUsers::class, 'phone_id', 'operator_id');
    }

}
