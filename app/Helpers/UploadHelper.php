<?php


namespace App\Helpers;

class UploadHelper
{
    const TYPE_DEFAULT = 'default';
    const TYPE_USER = 'user';

    public static function getPathFromData(?array $data=[]): string
    {
        $uploadPath = $data['uploadPath'] ?? 'common';
        $uploadPath = str_replace('.', '/', $uploadPath);

        $user = $data['userId'] ?? 'guest';

        return $uploadPath . '/' . $user;
    }

}