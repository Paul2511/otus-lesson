<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\UserSetting
 *
 * @property string $key
 * @property string $value
 * @property string $user_id
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserSetting whereValue($value)
 * @mixin \Eloquent
 */
class UserSetting extends BaseModel
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
        'user_id',
    ];

    /**
     * Получить пользователя настройки
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
