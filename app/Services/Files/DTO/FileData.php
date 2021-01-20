<?php


namespace App\Services\Files\DTO;

use Spatie\DataTransferObject\DataTransferObject;
abstract class FileData extends DataTransferObject
{
    public string $src;
    public ?string $path;
    public ?string $disk;
    public ?string $mime;
    public ?string $originalFileName;
    public ?string $type;


    public abstract static function fromArray(array $data);

}