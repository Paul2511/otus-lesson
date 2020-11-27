<?php


namespace App\Services\Users\Translators;


use App\Models\User;

class UserStatusesTranslator
{
    public function translate(string $lang): array
    {
        return [
            User::STATUS_INACTIVE => __('messages.users.status.inactive', [], $lang),
            User::STATUS_ACTIVE => __('messages.users.status.active', [], $lang),
            User::STATUS_PENDING => __('messages.users.status.pending', [], $lang),
            User::STATUS_DELETED => __('messages.users.status.deleted', [], $lang),
        ];
    }
}