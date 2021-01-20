<?php


namespace App\Services\Files\Handlers;


use Intervention\Image\Exception\ImageException;
use Intervention\Image\Facades\Image;
use Storage;

class CreateThumbnailHandler
{
    const WIDTH = 50;
    const HEIGHT = 50;
    const FORMAT = 'jpg';
    CONST QUALITY = 90;

    public function handle(string $original, string $thumbName, ?string $disk=null): bool
    {
        $disk = $disk ?? config('filesystems.default');
        try {
            $thumbnail = Image::make($original)
                ->resize(self::WIDTH, self::HEIGHT)
                ->encode(self::FORMAT, self::QUALITY);

            Storage::disk($disk)->put($thumbName, $thumbnail);
            return true;
        } catch (ImageException $e) {
            return false;
        }
    }
}