<?php


namespace App\Models;


class ModScenarioAliases extends BaseModel
{
    protected $connection = 'qsiq';

    protected $table = 'mod_scenario_aliases';

    protected $primaryKey = 'scenario_id';
}
