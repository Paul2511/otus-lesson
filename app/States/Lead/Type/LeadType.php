<?php


namespace App\States\Lead\Type;

use App\States\StateInterface;
use Spatie\ModelStates\State;
abstract class LeadType extends State implements StateInterface
{
    public static $name;

    public function label(): string
    {
        $name = static::$name ?? 'unknown';
        return trans('lead.type.'.$name);
    }
}