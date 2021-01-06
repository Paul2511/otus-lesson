<?php

namespace App\Events\Pet;

use App\Models\Pet;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class PetEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Pet
     */
    private $pet;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pet $pet)
    {
        $this->pet = $pet;
    }

    public function getPet(): Pet
    {
        return $this->pet;
    }

    public function broadcastOn()
    {
        return [];
    }
}
