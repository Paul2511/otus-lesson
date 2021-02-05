<?php

namespace App\Events\PetType;

use App\Models\PetType;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class PetTypeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var PetType
     */
    private $petType;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PetType $petType)
    {
        $this->petType = $petType;
    }

    public function getPetType(): PetType
    {
        return $this->petType;
    }

    public function broadcastOn()
    {
        return [];
    }
}
