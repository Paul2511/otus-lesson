<?php


namespace App\Services\Files\Helpers;
use Illuminate\Support\Facades\File;
class UploadHelper
{
    const TYPE_DEFAULT = 'default';
    const TYPE_USER = 'user';

    public static function getUploadPathFromArray(?array $data=[]): string
    {
        $uploadPath = $data['uploadPath'] ?? 'common';
        $uploadPath = str_replace('.', '/', $uploadPath);

        $user = $data['userId'] ?? 'guest';

        return $uploadPath . '/' . $user;
    }

    public static function getThumbFileName(string $originFilePath): string
    {
        return File::dirname($originFilePath) . DIRECTORY_SEPARATOR . 'thumb_'.File::basename($originFilePath);
    }

}