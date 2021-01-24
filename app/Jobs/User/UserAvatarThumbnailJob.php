<?php

namespace App\Jobs\User;

use App\Models\User;
use App\Services\Files\DTO\ImageData;
use App\Services\Files\FileService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserAvatarThumbnailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;
    /**
     * @var ImageData
     */
    protected $avatar;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, ImageData $avatar)
    {
        $this->user = $user;
        $this->avatar = $avatar;
    }

    protected function getFileService(): FileService
    {
        return app(FileService::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;

        $fileService = $this->getFileService();
        $thumbPath = $fileService->createThumbnail($this->avatar);
        $user->avatar->thumb_path = $thumbPath;
        $user->avatar->thumb_src = \Storage::url($thumbPath);
        $user->save();
    }
}
