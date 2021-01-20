<?php

namespace App\Jobs\User;

use App\Models\UserDetail;
use App\Services\Files\DTO\ImageData;
use App\Services\Files\FileService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserDetailAvatarThumbnailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $afterCommit = true;

    /**
     * @var UserDetail
     */
    protected $userDetail;
    /**
     * @var ImageData
     */
    protected $avatar;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(UserDetail $userDetail, ImageData $avatar)
    {
        $this->userDetail = $userDetail;
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
        $userDetail = $this->userDetail;

        $fileService = $this->getFileService();
        $thumbPath = $fileService->createThumbnail($this->avatar);
        $userDetail->avatar->thumb_path = $thumbPath;
        $userDetail->avatar->thumb_src = \Storage::url($thumbPath);
        $userDetail->save();
    }
}
