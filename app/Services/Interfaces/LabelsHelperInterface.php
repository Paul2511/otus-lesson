<?php


namespace App\Services\Interfaces;


interface LabelsHelperInterface
{
    /**
     * @return array
     */
    public function getLabels();

    /**
     * @param mixed $model
     * @return array
     */
    public function toArray($model);
}