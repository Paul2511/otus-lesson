<?php


namespace App\Services\Comments\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Support\Cache\CacheHelper;

class CacheCommentRepository extends CommentRepository
{

    public function findById(int $id): Comment
    {
        return CacheHelper::remember(Comment::query(), class_basename(Comment::class), $id)->findOrFail($id);
    }

    /**
     * @return Comment[]|Builder[]|Collection|mixed
     */
    public function get()
    {
        $query = $this->query;

        $key = CacheHelper::getKey($this->tag) . ':'.$this->request->getHash();
        $ttl = CacheHelper::getTTL($this->tag);

        return \Cache::tags($this->tag)->remember($key, $ttl, function () use ($query){
            return $query->get();
        });
    }

    public function create(array $data): Comment
    {
        $data = collect($data)->whereNotNull()->all();
        $result = Comment::create($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    /**
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Comment $comment)
    {
        $result = $comment->delete();

        \Cache::tags($this->tag)->flush();

        return $result;
    }

    public function update(Comment $comment, array $data): bool
    {
        $data = collect($data)->whereNotNull()->all();
        $result = $comment->update($data);

        \Cache::tags($this->tag)->flush();

        return $result;
    }
}