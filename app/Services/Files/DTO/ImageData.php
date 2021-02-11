<?php


namespace App\Services\Files\DTO;

class ImageData extends FileData
{
    public string $thumb_src;
    public ?string $thumb_path;
    public ?int $width;
    public ?int $height;

    protected bool $ignoreMissing = true;

    public static function fromArray(array $data): self
    {
        if (!isset($data['thumb_src'])) {
            $data['thumb_src'] = $data['src'];
        }
        return new self($data);
    }
}