<?php


namespace App\Services\Reports\Helpers;


class ReportsCallsFormDataHelper
{

    public function handle($query)
    {
        $calls = [];
        $aliases = [];
        $query->chunk(100, function ($data) use ( &$calls, &$aliases) {
            foreach ($data as $row) {
                $array = [];
                if (!empty($row["scenario_results_value"])) {
                    foreach ($row["scenario_results_value"] as $alias) {
                        $array[$alias['field_id']] = $alias['field_value'];
                    }
                }
                $call = array_merge_recursive(array(
                    'lead_id' => $row->lead_id,
                    'Дата звонка' => $row->calldate,
                    'Статус' => $row->status->name ?? '',
                    'ID звонка' => $row->uniqueid->name ?? '',
                    'Оператор' => !empty($row->user->last_name) ? $row->user->last_name . ' '. $row->user->first_name :'' ,
                    'Время разговора' => $row->billsec
                ),$array);
                $aliases = array_unique(array_merge($aliases, array_keys($call)));
                $calls[] = $call;
            }
        });
        $data = [];
        if (!empty($calls)) {
            foreach ($calls as $call)
            {
                foreach ($aliases as $alias)
                {
                    $data_call[$alias] = $call[$alias] ?? '';
                }
                $data[] = $data_call;
            }
        }
        return $data;
    }

}
