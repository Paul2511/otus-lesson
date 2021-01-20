<?php

namespace App\Jobs\Pet;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Pet;
use App\Services\Pets\Handlers\PetDeleteHandler;
class PetDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Pet
     */
    protected $pet;

    /** @var int */
    protected $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Pet $pet)
    {
        $this->pet = $pet;
        $this->userId = auth()->user()->getAuthIdentifier();
    }

    protected function getPetDeleteHandler(): PetDeleteHandler
    {
        return app(PetDeleteHandler::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $handler = $this->getPetDeleteHandler();
        $handler->handle($this->pet, ['userId'=>$this->userId]);
    }
}
