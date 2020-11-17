<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\CoreSetting
 *
 * @property string $key
 * @property string $value
 * @method static \Illuminate\Database\Eloquent\Builder|CoreSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoreSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoreSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|CoreSetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoreSetting whereValue($value)
 * @mixin \Eloquent
 */
class CoreSetting extends BaseModel
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

}
