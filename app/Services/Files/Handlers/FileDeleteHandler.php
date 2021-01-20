<?php


namespace App\Services\Files\Handlers;


use App\Helpers\LogHelper;
use Storage;
use App\Services\Files\Exceptions\FileDeleteException;
class FileDeleteHandler
{

    public function handle(string $file, ?string $disk=null): void
    {
        $disk = $disk ?? config('filesystems.default');
        try {
            Storage::disk($disk)->delete($file);
        } catch (FileDeleteException $e) {
            $logData['error'] = $e->getMessage();
            LogHelper::slack("Ошибка удаления файла {$file}", $logData);
        }
    }

}