<?php


namespace App\Models\Casts\Pet;

use App\Services\Files\Helpers\UploadHelper;
use App\Services\Files\DTO\ImageData;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Models\Pet;
use App\Services\Files\Helpers\SrcHelper;
class PhotoCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        $type = $this->getType($model);

        $data = $value ? json_decode($value, true) : SrcHelper::getPetDefaultPhoto($type);

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
        $type = $this->getType($model);
        $default = SrcHelper::getPetDefaultPhoto($type);
        if (!$value || !isset($value['src']) || $value['src'] === $default['src']) {
            $value = null;
        } else {
            $value['type'] = UploadHelper::TYPE_USER;
            $value = json_encode($value, JSON_UNESCAPED_UNICODE);
        }

        return $value;
    }

    private function getType(\Illuminate\Database\Eloquent\Model $model): string
    {

        if ($model instanceof Pet) {
            $type = $model->petType->slug;
        } else {
            $type = 'unknown';
        }

        return $type;
    }

}