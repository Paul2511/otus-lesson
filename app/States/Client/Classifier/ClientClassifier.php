<?php


namespace App\States\Client\Classifier;

use App\States\StateInterface;
use Spatie\ModelStates\State;
abstract class ClientClassifier extends State implements StateInterface
{
    public static $name;

    public function label(): string
    {
        $name = static::$name ?? 'unknown';
        return trans('client.classifier.'.$name);
    }
}