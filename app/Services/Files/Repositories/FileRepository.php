<?php


namespace App\Services\Files\Repositories;

use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
class FileRepository
{

    public function getFile(string $path, ?string $disk=null): ?string
    {
        $disk = $disk ?? config('filesystems.default');

        try {
            return Storage::disk($disk)->get($path);
        } catch (FileNotFoundException $e) {
            return null;
        }
    }


    public function getAllFiles(?string $disk=null): array
    {
        $disk = $disk ?? config('filesystems.default');

        return Storage::disk($disk)->allFiles();
    }
}