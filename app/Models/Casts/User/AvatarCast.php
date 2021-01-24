<?php


namespace App\Models\Casts\User;

use App\Services\Files\DTO\ImageData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Services\Files\Helpers\UploadHelper;
use App\Services\Files\Helpers\SrcHelper;
class AvatarCast implements CastsAttributes
{

    public function get($model, $key, $value, $attributes)
    {
        $data = $value ? json_decode($value, true) : SrcHelper::getUserDefaultAvatar();
        $result = ImageData::fromArray($data);

        return $result;
    }

    public function set($model, $key, $value, $attributes)
    {
        if ($value === null) {
            return null;
        }
        if ($value instanceof ImageData) {
            $value = $value->toArray();
        }

        if (!$value || !isset($value['src']) || $value['src'] === SrcHelper::NO_AVATAR_SRC) {
            $value = null;
        } else {
            $value['type'] = UploadHelper::TYPE_USER;
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        return $value;
    }


}