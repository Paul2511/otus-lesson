<?php


namespace App\States\User\Role;

use App\States\StateInterface;
use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;
abstract class UserRole extends State implements StateInterface
{
    public static $name;

    public function label(): string
    {
        $name = static::$name ?? 'unknown';
        return trans('user.role.'.$name);
    }

    public static function config(): StateConfig
    {
        return parent::config()->default(ClientUserRole::class);
    }
}