<?php


namespace App\Services\Specializations;

use App\Exceptions\Specialization\SpecializationDeleteException;
use App\Exceptions\Specialization\SpecializationUpdateException;
use App\Models\Specialization;
use App\Services\Specializations\DTO\SpecializationDTO;
use App\Services\Specializations\Handlers\SpecializationDeleteHandler;
use App\Services\Specializations\Repositories\SpecializationRepository;
use App\Services\Translates\DTO\TranslateDTO;
use App\Services\Translates\TranslateService;
use Support\Log\LogHelper;
use App\Exceptions\Specialization\SpecializationCreateException;
class SpecializationService
{

    /**
     * @var SpecializationRepository
     */
    private $repository;
    /**
     * @var TranslateService
     */
    private $translateService;
    /**
     * @var SpecializationDeleteHandler
     */
    private $deleteHandler;

    public function __construct(
        SpecializationRepository $repository,
        TranslateService $translateService,
        SpecializationDeleteHandler $deleteHandler
    )
    {
        $this->repository = $repository;
        $this->translateService = $translateService;
        $this->deleteHandler = $deleteHandler;
    }

    public function findById(int $id): Specialization
    {
        return $this->repository->findById($id);
    }

    /**
     * @return Specialization[]|array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getAll(?int $perPage = null)
    {
        $result = $perPage ? $this->repository->paginate($perPage) : $this->repository->get();
        return $result ?? [];
    }

    /**
     * @throws SpecializationCreateException
     */
    public function create(SpecializationDTO $createData): Specialization
    {
        /** @var TranslateDTO[] $translates */
        $translates = $createData->translates;

        $data = $createData->toArray();

        \DB::beginTransaction();

        try {
            $specialization = $this->repository->create($data);

            if ($translates && count($translates)) {
                foreach ($translates as $translate) {
                    $translate->row_id = $specialization->id;
                    $this->translateService->create($translate);
                }
            }

            \DB::commit();

            $specialization->refresh();
            $specialization->searchable();
            return $specialization;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка создания специализации", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'specializationData'=>$data
            ]);
            throw new SpecializationCreateException($e->getMessage());
        }
    }

    /**
     * @throws SpecializationDeleteException
     */
    public function delete(Specialization $specialization): void
    {
        \DB::beginTransaction();
        try {
            $this->deleteHandler->handle($specialization);
            \DB::commit();
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка удаления специализации", [
                'userId' => auth()->user()->getAuthIdentifier(),
                'error' => $e->getMessage(),
                'specializationId' => $specialization->id
            ]);
            throw new SpecializationDeleteException($e->getMessage());
        }
    }

    /**
     * @throws SpecializationUpdateException
     */
    public function update(Specialization $specialization, SpecializationDTO $updateData): Specialization
    {
        /** @var TranslateDTO[] $translates */
        $translates = $updateData->translates;
        $data = $updateData->all();

        \DB::beginTransaction();

        try {
            $result = $this->repository->update($specialization, $data);
            if (!$result) {
                throw new SpecializationUpdateException();
            }

            if ($translates && count($translates) ) {
                foreach ($translates as $translateData) {
                    if ($translateData->id) {
                        $translate = $this->translateService->findById($translateData->id);
                        $this->translateService->update($translate, $translateData);
                    }
                }
            }

            \DB::commit();
            $specialization->refresh();
            $specialization->searchable();
            return $specialization;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка обновления специализации #{$specialization->id}", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'specializationData'=>$data
            ]);
            throw new SpecializationUpdateException($e->getMessage());
        }
    }
}