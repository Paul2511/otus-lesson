<?php


namespace App\Policies;


abstract class Permission
{

    const VIEW_ANY         = 'viewAny';
    const VIEW_TOTALLY_ANY = 'viewTotallyAny';
    const VIEW             = 'view';
    const CREATE           = 'create';
    const READ             = 'read';
    const UPDATE           = 'update';
    const DELETE           = 'delete';

}