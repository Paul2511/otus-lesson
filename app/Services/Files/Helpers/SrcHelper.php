<?php


namespace App\Services\Files\Helpers;


use App\Models\PetType;
use App\Services\PetTypes\PetTypeService;

class SrcHelper
{
    const NO_AVATAR_SRC = '/images/no-avatar.jpg';

    private function getPetTypeService():PetTypeService
    {
        return app(PetTypeService::class);
    }

    public static function getUserDefaultAvatar(): array
    {
        return [
            'src'=>self::NO_AVATAR_SRC,
            'thumb_src'=>self::NO_AVATAR_SRC,
            'type'=>UploadHelper::TYPE_DEFAULT
        ];

    }

    public static function getPetDefaultPhoto($type): array
    {
        return [
            'src' => "/images/{$type}-photo.jpg",
            'thumb_src'=>"/images/{$type}-photo.jpg",
            'type'=>UploadHelper::TYPE_DEFAULT,
        ];
    }

    public function getAllPetDefaultPhoto(): array
    {
        $result = [];

        $this->getPetTypeService()->getAll()->each(function (PetType $petType) use (&$result) {
            $default = self::getPetDefaultPhoto($petType->slug);
            $src = $default['src'];

            try {
                file_get_contents(public_path().$src);
            } catch (\Exception $e) {
                $default['src'] = '/images/unknown-photo.jpg';
            }
            $default['petType'] = $petType->id;
            $result[] = $default;
        });

        return $result;
    }
}