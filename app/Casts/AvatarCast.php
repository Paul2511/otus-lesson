<?php


namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;


class AvatarCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        if (!$value) {
            $result = [
                'src'=>'/images/no-avatar.jpg'
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