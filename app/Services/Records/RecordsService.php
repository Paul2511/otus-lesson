<?php
namespace App\Services\Records;

use Gordyush\Records\Services\Records\Records;

class RecordsService
{
    public function getRecords(array $data)
    {
        return app(Records::class)->getRecords($data);
    }

}
