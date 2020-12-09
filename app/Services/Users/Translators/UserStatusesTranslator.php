<?php

namespace App\Services\Users\Translators;

use App\Models\User;

class UserStatusesTranslator {
    
    public function translator(string $lang):array
    {
        return [
            User::STATUS_ACTIVE => __('admin.users.active',[],$lang),
            User::STATUS_INACTIVE => __('admin.users.inactive',[],$lang),
        ];
    }
}
