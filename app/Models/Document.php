<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Document
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $url
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Document newModelQuery()
 * @method static Builder|Document newQuery()
 * @method static Builder|Document query()
 * @method static Builder|Document whereCreatedAt($value)
 * @method static Builder|Document whereId($value)
 * @method static Builder|Document whereName($value)
 * @method static Builder|Document whereType($value)
 * @method static Builder|Document whereUpdatedAt($value)
 * @method static Builder|Document whereUrl($value)
 * @mixin \Eloquent
 */
class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'url',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class)
            ->using(DocumentService::class);
    }

}
