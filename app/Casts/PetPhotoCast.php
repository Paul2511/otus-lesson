<?php


namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Models\Pet;

class PetPhotoCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        if ($model instanceof Pet) {
            if (!$value) {
                $type = $model->petType->slug;
                $result = [
                    'src'=>"/images/{$type}-photo.jpg"
                ];
            }
            else {
                $result = json_decode($value, true);
            }
            return $result;
        } else {
            return $value;
        }
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value || !isset($value['previewPath'])) {
            $value = null;
        }
        return $value;
    }


}