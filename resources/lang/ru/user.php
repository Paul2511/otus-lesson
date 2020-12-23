<?php

use App\Models\User;


return [

    'role' => 'Роль',

    'role_' . User::ROLE_DEFAULT   => 'Пользователь',
    'role_' . User::ROLE_MODERATOR => 'Модератор',
    'role_' . User::ROLE_ADMIN     => 'Администратор',

];
