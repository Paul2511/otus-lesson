<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\BaseModel
 *
 * @property-read Collection|Comment[]  $comments
 *
 */

class BaseModel extends Model
{
    /**
     * Имя типа для модели комментариев.
     * Устанавливается в тех моделях, где предусмотрены комментарии
     * @var string
     */
    public $commentType = '';


    /**
     * Список комментариев
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'row_id')->where('type', $this->commentType);
    }

}
