<?php


namespace App\States\Specialist\Classifier;

use App\States\StateInterface;
use Spatie\ModelStates\State;
abstract class SpecialistClassifier extends State implements StateInterface
{
    public static $name;

    public function label(): string
    {
        $name = static::$name ?? 'unknown';
        return trans('specialist.classifier.'.$name);
    }
}