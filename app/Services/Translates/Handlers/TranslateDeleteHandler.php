<?php


namespace App\Services\Translates\Handlers;


use App\Exceptions\Translate\TranslateDeleteException;
use App\Models\Translate;
use App\Services\Translates\Repositories\TranslateRepository;

class TranslateDeleteHandler
{
    /**
     * @var TranslateRepository
     */
    private $repository;

    public function __construct(TranslateRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws TranslateDeleteException
     */
    public function handle(Translate $translate): void
    {
        try {
            $this->repository->delete($translate);
        } catch (\Throwable $e) {
            throw new TranslateDeleteException($e->getMessage());
        }
    }
}