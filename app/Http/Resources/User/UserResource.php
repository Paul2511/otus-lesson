<?php


namespace App\Http\Resources\User;

use App\Http\Resources\Comment\CommentResource;
use App\Models\User;
use App\Http\Resources\BaseResource;
/**
 * @mixin User
 */
class UserResource extends BaseResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $result = parent::toArray($request);

        if ($this->isClient) {
            $result['client_id'] = $this->client->id;
        }

        /** @var User $my */
        $my = auth()->user();
        if (!$my->canManage) {
            unset($result['currentStatus']);
            unset($result['currentRole']);
        } else {
            $result['comments'] = CommentResource::collection($this->comments);
            if ($this->isClient) {
                $result['petsCount'] = $this->client->pets()->count();
            }
        }

        return $result;
    }
}