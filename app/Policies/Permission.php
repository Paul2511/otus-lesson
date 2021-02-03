<?php

namespace App\Policies;

use App\Models\User;

abstract class Permission
{
	const VIEW_ANY = 'viewAny';
	const CREATE = 'create';
	const UPDATE = 'update';
	const EDIT = 'edit';
	const VIEW = 'view';
	const DELETE = 'delete';
        const RESTORE = 'restore';
        const FORCE_DELETE = 'force_delete';
        
        
        const GATE_PROMOTION = 'GATE_PROMOTION';
        
        public static $gates = [
            self::GATE_PROMOTION,
        ];
    
}
