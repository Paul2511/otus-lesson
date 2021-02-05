<?php


namespace App\Models\Casts\User;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Support\Person\PersonName\PersonNameData;
class NameCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        $name = PersonNameData::fromFullName($value);

        if (!$name->displayName && $model instanceof User) {
            $name->displayName = $model->role->label();
        }

        return $name;
    }

    public function set($model, $key, $value, $attributes)
    {
        if ($value === null) {
            return null;
        }
        if ($value instanceof PersonNameData) {
            return $value->getFullName();
        }

        return trim((string)$value);
    }
}