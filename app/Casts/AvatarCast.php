<?php


namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Helpers\BaseHelper;

class AvatarCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        /**
         * Comment: Самое удобное место для этой логики здесь.
                    Тут можно избежать ошибок и быть увернным в результате
         */
        if (!$value) {
            //Только вот такой рефракторинг:
            $result = [
                'src'=>BaseHelper::getUserDefaultAvatar()
            ];
        }
        else {
            $result = json_decode($value, true);
        }

        return $result;
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value || !isset($value['previewPath'])) {
            $value = null;
        }
        return $value;
    }


}