<?php

namespace App\Services\Routes\Providers\Admin;

final class AdminRoutes{
    
        const ADMIN_INDEX = 'admin.index';
        
	const ADMIN_CATEGORIES_INDEX = 'admin.categories.index';
	const ADMIN_CATEGORIES_CREATE = 'admin.categories.create';
	const ADMIN_CATEGORIES_EDIT = 'admin.categories.edit';
	const ADMIN_CATEGORIES_UPDATE = 'admin.categories.update';
	const ADMIN_CATEGORIES_DELETE = 'admin.categories.delete';
	const ADMIN_CATEGORIES_STORE = 'admin.categories.store';
        const ADMIN_CATEGORIES_SHOW = 'admin.categories.show';
        
        const ADMIN_USERS_INDEX = 'admin.users.index';
	const ADMIN_USERS_CREATE = 'admin.users.create';
	const ADMIN_USERS_EDIT = 'admin.users.edit';
	const ADMIN_USERS_UPDATE = 'admin.users.update';
	const ADMIN_USERS_DELETE = 'admin.users.delete';
	const ADMIN_USERS_STORE = 'admin.users.store';
        const ADMIN_USERS_SHOW = 'admin.users.show';
        
        const ADMIN_USERS_PROFILE = 'admin.users.profile';

}