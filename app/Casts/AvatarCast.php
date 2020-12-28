<?php


namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\BaseHelper;
use App\Helpers\UploadHelper;
class AvatarCast implements CastsAttributes
{

    public function get($model, $key, $value, $attributes)
    {
        if (!$value) {
            $result = [
                'src'=>BaseHelper::getUserDefaultAvatar(),
                'type'=>UploadHelper::TYPE_DEFAULT
            ];
        }
        else {
            $result = json_decode($value, true);
        }

        return $result;
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value || !isset($value['src']) || $value['src'] === BaseHelper::getUserDefaultAvatar()) {
            $value = null;
        } else {
            $value['type'] = UploadHelper::TYPE_USER;
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
        return $value;
    }


}