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
        'password_confirmation' => 'Подтверждение пароля',
        'image' => 'Изображение',
        'name' => 'Имя',
        'pet_type_id' => 'Тип',
        'sex' => 'Пол',
        'oldPassword' => 'Текущий пароль',
        'newPassword' => 'Новый пароль',
        'newPassword_confirmation' => 'Подтверждение нового пароля',
    ],
    'required' => 'Поле :attribute обязательно для заполнения',
    'email' => 'Неверный email',
    'in' => 'Неверное поле :attribute',
    'password' => 'Неверный пароль',
    'image' => 'Файл должен быть изображением',
    'mimes' => 'Поддерживаются файлы с расширениями: :values',
    'confirmed'=>'Пароли не совпадают',
    'max' => [
        'file' => 'Максимально допустимый размер файла: :max килобайт',
    ],
    'unique' => 'Поле :attribute уже занято'
];
