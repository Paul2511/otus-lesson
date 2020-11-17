<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\BasePivot
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BasePivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasePivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BasePivot query()
 * @mixin \Eloquent
 */
class BasePivot extends Pivot
{

    const STATUS_INACTIVE = 10;
    const STATUS_MODERATION = 20;
    const STATUS_ACTIVE = 30;
    const STATUS_DELETED = 40;
    const STATUS_DELETED_BY_OWNER = 50;
    const STATUS_DELETED_BY_ADMIN = 60;
    const STATUS_NEW = 70;
    const STATUS_SEND = 80;
    const STATUS_FAIL = 90;
    const STATUS_CANCEL = 100;

    /**
     * Список доступных статусов сущности
     *
     * @return array
     */
    public static function getStatuses() {
        return [];
    }

}
