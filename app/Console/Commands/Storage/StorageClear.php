<?php

namespace App\Console\Commands\Storage;

use App\Models\Pet;
use App\Services\Files\DTO\ImageData;
use App\Services\Files\FileService;
use Illuminate\Console\Command;
use App\Services\Files\Handlers\FileDeleteHandler;
use App\Models\User;
class StorageClear extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:clear
                            {disk=public}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleans local storage of unused files';

    /** @var array  */
    private $uses = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function getFileService(): FileService
    {
        return app(FileService::class);
    }

    protected function getFileDeleteHandler(): FileDeleteHandler
    {
        return app(FileDeleteHandler::class);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deleted = 0;

        //Определяем используемые файлы
        $details = User::whereNotNull('avatar')->get();
        $details->each(function (User $user) {
            $this->addUses($user->avatar);
        });

        $pets = Pet::whereNotNull('photo')->get();
        $pets->each(function (Pet $pet) {
            $this->addUses($pet->photo);

        });

        $fileService = $this->getFileService();
        $fileDeleteHandler = $this->getFileDeleteHandler();

        //Получаем список файлов на диске
        $disk = $this->argument('disk');

        $files = $fileService->getAllFiles($disk);
        $count = count($files);

        //Удаление неиспользуемых
        if ($count) {
            foreach ($files as $file) {
                if (!in_array($file, $this->uses)) {
                    $fileDeleteHandler->handle($file, $disk);
                    $deleted++;
                }
            }
        }

        $this->info("Count of deleted files: {$deleted} out of {$count}");

        return 0;
    }

    private function addUses(ImageData $file): void
    {
        $disk = $this->argument('disk');
        if ($file->disk == $disk) {
            $this->uses[] = $file->path;
            if ($file->thumb_path) {
                $this->uses[] = $file->thumb_path;
            }
        }
    }
}
