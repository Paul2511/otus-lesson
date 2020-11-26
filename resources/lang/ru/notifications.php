<?php

use App\Models\Notification;

return [
    'types' => [
        Notification::TYPE_ADMIN_CHECK_SCHEDULE => 'admin_check_schedule',
        Notification::TYPE_ADMIN_CHECK_CARD => 'admin_check_card',
        Notification::TYPE_ADMIN_CHECK_COMMENT => 'admin_check_comment',
        Notification::TYPE_ADMIN_ADD_MESSAGE => 'admin_add_message',
        Notification::TYPE_NEWS => 'news',
        Notification::TYPE_GUEST_REGISTER => 'guest_register',
        Notification::TYPE_GUEST_VERIFY => 'guest_verify',
        Notification::TYPE_GUEST_CHECK_SCHEDULE => 'guest_check_schedule',
        Notification::TYPE_GUEST_CHECK_CARD => 'guest_check_card',
        Notification::TYPE_GUEST_ADD_COMMENT => 'guest_add_comment',
        Notification::TYPE_GUEST_ADD_MESSAGE => 'guest_add_message',
    ],
];
