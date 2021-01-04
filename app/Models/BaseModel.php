<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
/**
 * App\Models\BaseModel
 *
 * @property-read Collection|Comment[]  $comments
 * @property-read Collection|Translate[]    $translates
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
     * Имя типа для модели транслита.
     * Устанавливается в тех моделях, где предусмотрены поля на разных языках
     * @var string
     */
    public $translateType = '';

    /**
     * Список комментариев
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'row_id')->where('type', $this->commentType);
    }

    /**
     * Модель перевода
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function translates()
    {
        return $this->hasMany(Translate::class, 'row_id')->where('type', $this->translateType);
    }

    public function translateAttribute(?string $default=''): string
    {
        $locale = \App::currentLocale();

        /** @var Translate $translate */
        $translate = $this->translates->where('locale', $locale)->first();

        if ($translate) {
            return $translate->value;
        }

        return $default;
    }
}
