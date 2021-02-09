<?php


namespace App\Services\Reports\Repositories;


use App\Models\ModRecords;

class EloquentModRecordsRepository
{

    public function getRecords(array $data)
    {
        return ModRecords::with('status','user','scenario_results_value','scenario_alias')
            ->whereBetween('calldate',[date('Y-m-d 00:00:00', strtotime($data['date_start'])),
                                       date('Y-m-d 23:59:59', strtotime($data['date_end']))])
            ->whereQueue($data['project']);

    }
}
