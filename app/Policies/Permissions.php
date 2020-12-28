<?php


namespace App\Policies;


abstract class Permissions
{
    const VIEW_ANY         = 'viewAny';
    const VIEW             = 'view';
    const CREATE           = 'create';
    const ACTIVATE         = 'activate';
    const UPDATE           = 'update';
    const RESTORE          = 'restore';
    const DELETE           = 'delete';
    const VIEW_SOURCE       = 'viewResource';
}
