<?php


namespace App\Services\Translates;

use App\Exceptions\Translate\TranslateCreateException;
use App\Exceptions\Translate\TranslateUpdateException;
use App\Models\Translate;
use App\Services\Translates\DTO\TranslateDTO;
use App\Services\Translates\Handlers\TranslateDeleteHandler;
use App\Services\Translates\Repositories\TranslateRepository;
use Support\Log\LogHelper;

class TranslateService
{
    /**
     * @var TranslateRepository
     */
    private $repository;
    /**
     * @var TranslateDeleteHandler
     */
    private $deleteHandler;

    public function __construct(
        TranslateRepository $repository,
        TranslateDeleteHandler $deleteHandler
    )
    {
        $this->repository = $repository;
        $this->deleteHandler = $deleteHandler;
    }

    public function findById(int $id): Translate
    {
        return $this->repository->findById($id);
    }

    /**
     * @throws TranslateCreateException
     */
    public function create(TranslateDTO $createData): Translate
    {
        $data = $createData->toArray();

        try {
            return $this->repository->create($data);
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка создания Translate", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'translateData'=>$data
            ]);
            throw new TranslateCreateException($e->getMessage());
        }
    }

    /**
     * @throws \App\Exceptions\Translate\TranslateDeleteException
     */
    public function delete(Translate $translate): void
    {
        $this->deleteHandler->handle($translate);
    }

    /**
     * @throws TranslateUpdateException
     */
    public function update(Translate $translate, TranslateDTO $updateData): Translate
    {
        $data = $updateData->all();

        try {
            $result = $this->repository->update($translate, $data);

            if (!$result) {
                throw new TranslateUpdateException();
            }
            $translate->refresh();
            return $translate;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка обновления Translate", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'translateData'=>$data
            ]);
            throw new TranslateUpdateException($e->getMessage());
        }
    }
}