<?php


namespace App\Http\Resources\Comment;


use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Comment
 */
class CommentResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);

        $result['user'] = $this->user->toArray();

        /** @var User $my */
        $my = auth()->user();
        $result['canEdit'] = $this->user_id == $my->id;

        return $result;
    }
}