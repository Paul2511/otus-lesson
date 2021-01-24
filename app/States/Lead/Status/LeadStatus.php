<?php


namespace App\States\Lead\Status;

use App\States\StateInterface;
use Spatie\ModelStates\State;
abstract class LeadStatus extends State implements StateInterface
{
    public static $name;

    public function label(): string
    {
        $name = static::$name ?? 'unknown';
        return trans('lead.status.'.$name);
    }
}