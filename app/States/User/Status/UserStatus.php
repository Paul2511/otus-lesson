<?php


namespace App\States\User\Status;

use App\States\StateInterface;
use Spatie\ModelStates\State;
abstract class UserStatus extends State implements StateInterface
{
    public static $name;

    abstract public function color(): string;

    public function label(): string
    {
        $name = static::$name ?? 'unknown';
        return trans('user.status.'.$name);
    }
}