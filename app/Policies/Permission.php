<?php


namespace App\Policies;


abstract class Permission
{
    public const VIEW_ANY = 'viewAny';
    public const VIEW = 'view';
    public const CREATE = 'create';
    public const UPDATE = 'update';
    public const DELETE = 'delete';
}
