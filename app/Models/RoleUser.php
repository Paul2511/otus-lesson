<?php

namespace App\Models;

/**
 * App\Models\RoleUser
 *
 * @property string $user_id
 * @property string $role_id
 * @property \Illuminate\Support\Carbon|null $active_from
 * @property \Illuminate\Support\Carbon|null $active_to
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property-read \App\Models\User $role
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereActiveFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereActiveTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RoleUser whereUserId($value)
 * @mixin \Eloquent
 */
class RoleUser extends BasePivot
{
    public $timestamps = false;

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'role_id',
        'active_from',
        'active_to',
    ];

    /**
     * Поля с приведением к нативным типам
     *
     * @var array
     */
    protected $casts = [
        'active_from' => 'datetime',
        'active_to' => 'datetime',
    ];

    /**
     * Получить пользователя связи
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить роль связи
     */
    public function role()
    {
        return $this->belongsTo(User::class);
    }

}
