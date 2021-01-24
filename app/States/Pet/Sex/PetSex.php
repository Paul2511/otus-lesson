<?php


namespace App\States\Pet\Sex;

use App\States\StateInterface;
use Spatie\ModelStates\State;
abstract class PetSex extends State implements StateInterface
{
    public static $name;

    public function label(): string
    {
        $name = static::$name ?? 'unknown';
        return trans('pet.sex.'.$name);
    }
}