<?php


namespace App\Models\Traits;


use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;

trait HasComments
{
    public function comments()
    {
        $modelName = strtolower(class_basename(self::class));
        /** @var $this Model */
        return $this->hasMany(Comment::class, 'row_id')->where('type', $modelName);
    }
}