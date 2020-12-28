<?php


namespace App\Casts;

use App\Helpers\UploadHelper;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Models\Pet;
use App\Helpers\BaseHelper;

class PetPhotoCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        if ($model instanceof Pet) {
            if (!$value) {
                $type = $model->petType->slug;
                $result = [
                    'src'=>BaseHelper::getPetDefaultPhoto($type),
                    'type'=>UploadHelper::TYPE_DEFAULT
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
        if ($model instanceof Pet) {
            $type = $model->petType->slug;
            if (!$value || !isset($value['src']) || $value['src']===BaseHelper::getPetDefaultPhoto($type)) {
                $value = null;
            } else {
                $value['type'] = UploadHelper::TYPE_USER;
                $value = json_encode($value, JSON_UNESCAPED_UNICODE);
            }
        }

        return $value;
    }


}