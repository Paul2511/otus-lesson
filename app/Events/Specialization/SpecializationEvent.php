<?php

namespace App\Events\Specialization;

use App\Models\Specialization;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

abstract class SpecializationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Specialization
     */
    private $specialization;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Specialization $specialization)
    {
        $this->specialization = $specialization;
    }

    public function getSpecialization(): Specialization
    {
        return $this->specialization;
    }

    public function broadcastOn()
    {
        return [];
    }
}
