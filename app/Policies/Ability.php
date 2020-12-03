<?php


namespace App\Policies;


abstract class Ability
{
    const VIEW_ANY = 'viewAny';
    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const STORE = 'store';
    const DELETE = 'delete';
}