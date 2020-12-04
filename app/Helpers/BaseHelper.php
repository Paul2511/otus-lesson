<?php


namespace App\Helpers;


class BaseHelper
{
    const NO_AVATAR_SRC = '/images/no-avatar.jpg';

    public static function getUserDefaultAvatar()
    {
        return self::NO_AVATAR_SRC;
    }

    public static function getPetDefaultPhoto($type)
    {
        return "/images/{$type}-photo.jpg";
    }
}