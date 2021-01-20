<?php


namespace App\Helpers;

use App\Services\Files\Helpers\UploadHelper;
class BaseHelper
{
    const NO_AVATAR_SRC = '/images/no-avatar.jpg';

    public static function getUserDefaultAvatar(): array
    {
        return [
            'src'=>self::NO_AVATAR_SRC,
            'type'=>UploadHelper::TYPE_DEFAULT
        ];

    }

    public static function getPetDefaultPhoto($type): array
    {
        return [
            'src' => "/images/{$type}-photo.jpg",
            'type'=>UploadHelper::TYPE_DEFAULT
        ];
    }
}