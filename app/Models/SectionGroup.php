<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\SectionGroup
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SectionGroup newModelQuery()
 * @method static Builder|SectionGroup newQuery()
 * @method static Builder|SectionGroup query()
 * @method static Builder|SectionGroup whereCreatedAt($value)
 * @method static Builder|SectionGroup whereDescription($value)
 * @method static Builder|SectionGroup whereId($value)
 * @method static Builder|SectionGroup whereName($value)
 * @method static Builder|SectionGroup whereSlug($value)
 * @method static Builder|SectionGroup whereUpdatedAt($value)
 * @mixin Eloquent
 */
class SectionGroup extends Model
{
    use HasFactory;

    const STATUS_INACTIVE = 10;
    const STATUS_ACTIVE = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
