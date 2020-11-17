<?php

namespace App\Models;

use App\Traits\UseUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\File
 *
 * @property string $id
 * @property string $external_hash
 * @property string $name_view
 * @property string $name_raw
 * @property string $path
 * @property string $extension
 * @property string $mime
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereExtension($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereExternalHash($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereMime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereNameRaw($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereNameView($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @mixin \Eloquent
 */
class File extends BaseModel
{
    use HasFactory, UseUuid;

    public $timestamps = false;

    /**
     * Поля с приведением к нативным типам
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    /**
     * Поля массового назначения
     *
     * @var array
     */
    protected $fillable = [
        'external_hash',
        'name_view',
        'name_raw',
        'path',
        'extension',
        'mime',
        'size',
    ];

}
