<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Watson\Rememberable\Rememberable;
use App\Services\Cache\CacheHelper;

/**
 * App\Models\Translate
 *
 * @property int $id
 * @property string $type
 * @property int $row_id
 * @property string $locale
 * @property string $value
 * @method static Builder|Translate newModelQuery()
 * @method static Builder|Translate newQuery()
 * @method static Builder|Translate query()
 * @method static Builder|Translate whereId($value)
 * @method static Builder|Translate whereRowId($value)
 * @method static Builder|Translate whereType($value)
 * @method static Builder|Translate whereLocale($value)
 * @method static Builder|Translate whereValue($value)
 * @mixin \Eloquent
 *
 */
class Translate extends BaseModel
{
    use HasFactory;

    use Rememberable;

    protected $rememberCachePrefix = 'translate';

    public $timestamps = false;

    const TYPE_PET_TYPE = 'petType';
    const TYPE_SPECIALIZATION = 'specialization';

    protected $fillable = [
        'type', 'row_id', 'locale', 'value'
    ];
}
