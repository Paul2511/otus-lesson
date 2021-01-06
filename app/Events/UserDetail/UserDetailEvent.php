<?php

namespace App\Events\UserDetail;

use App\Models\UserDetail;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class UserDetailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var UserDetail
     */
    private $userDetail;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(UserDetail $userDetail)
    {
        $this->userDetail = $userDetail;
    }

    public function getUserDetail(): UserDetail
    {
        return $this->userDetail;
    }

    public function broadcastOn()
    {
        return [];
    }
}
