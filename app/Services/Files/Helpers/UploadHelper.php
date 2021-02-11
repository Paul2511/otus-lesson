<?php


namespace App\Services\Files\Helpers;
use Illuminate\Support\Facades\File;
class UploadHelper
{
    const TYPE_DEFAULT = 'default';
    const TYPE_USER = 'user';

    const DEFAULT_UPLOAD_PATH = 'common';
    const DEFAULT_UPLOAD_ID = 'guest';


    public static function getThumbFileName(string $originFilePath): string
    {
        return File::dirname($originFilePath) . DIRECTORY_SEPARATOR . 'thumb_'.File::basename($originFilePath);
    }

}