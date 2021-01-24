<?php


namespace App\Models\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use App\Support\Phone\PhoneData;
use Support\Phone\PhoneFormat;
class PhoneCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return PhoneData::fromPhone($value);
    }

    public function set($model, $key, $value, $attributes)
    {
        if ($value === null) {
            return null;
        }
        if ($value instanceof PhoneData) {
            $value = $value->phone;
        }

        return PhoneFormat::purifyPhone($value);
    }

}