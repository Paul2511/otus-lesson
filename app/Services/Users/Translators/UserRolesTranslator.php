<?php


namespace App\Services\Users\Translators;


use App\Models\Role;

class UserRolesTranslator
{
    public function translate(string $lang): array
    {
        return [
            Role::ROLE_USER => __('messages.roles.user', [], $lang),
            Role::ROLE_MANAGER => __('messages.roles.manager', [], $lang),
            Role::ROLE_ADMIN => __('messages.roles.admin', [], $lang),
        ];
    }

}