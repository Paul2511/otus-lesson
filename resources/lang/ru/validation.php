<?php

return [
    'attributes' => [
        'email' => 'Email',
        'role' => 'Роль',
        'status' => 'Статус',
        'lastname' => 'Фамилия',
        'firstname' => 'Имя',
        'middlename' => 'Отчество',
        'password' => 'Пароль',
        'image' => 'Изображение'
    ],
    'required' => 'Поле :attribute обязательно для заполнения',
    'email' => 'Неверный email',
    'in' => 'Неверное поле :attribute',
    'password' => 'Неверный пароль',
    'image' => 'Файл должен быть изображением',
    'mimes' => 'Поддерживаются файлы с расширениями: :values',
    'max' => [
        'file' => 'Максимально допустимый размер файла: :max килобайт',
    ],
    'unique' => 'Поле :attribute уже занято'
];
