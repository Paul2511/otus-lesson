<?php


namespace App\Services\Interfaces;


interface LabelsHelperInterface
{
    /**
     * @param mixed $model
     * @return array
     */
    public function getLabels($model);

    /**
     * @param mixed $model
     * @return array
     */
    public function toArray($model);
}