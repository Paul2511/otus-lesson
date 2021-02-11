<?php


namespace App\Services\PetTypes;

use App\Exceptions\PetType\PetTypeDeleteException;
use App\Exceptions\PetType\PetTypeUpdateException;
use App\Models\PetType;
use App\Services\PetTypes\DTO\PetTypeDTO;
use App\Services\PetTypes\Handlers\PetTypeDeleteHandler;
use App\Services\PetTypes\Repositories\PetTypeRepository;
use App\Services\Translates\DTO\TranslateDTO;
use App\Services\Translates\TranslateService;
use Support\Log\LogHelper;
use App\Exceptions\PetType\PetTypeCreateException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PetTypeService
{

    /**
     * @var PetTypeRepository
     */
    private $repository;
    /**
     * @var TranslateService
     */
    private $translateService;
    /**
     * @var PetTypeDeleteHandler
     */
    private $deleteHandler;

    public function __construct(
        PetTypeRepository $repository,
        TranslateService $translateService,
        PetTypeDeleteHandler $deleteHandler
    )
    {
        $this->repository = $repository;
        $this->translateService = $translateService;
        $this->deleteHandler = $deleteHandler;
    }

    public function findById(int $id): PetType
    {
        return $this->repository->findById($id);
    }

    /**
     * @return PetType[]|array|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed
     */
    public function getAll(?int $perPage = null, ?bool $withRequest = false)
    {
        $repository = $this->repository;

        if ($withRequest) {
            $repository = $repository->withRequest();
        }

        $result = $perPage ? $repository->paginate($perPage) : $repository->get();
        return $result ?? [];
    }

    /**
     * @throws PetTypeCreateException
     */
    public function create(PetTypeDTO $createData): PetType
    {
        /** @var TranslateDTO[] $translates */
        $translates = $createData->translates;

        $data = $createData->toArray();

        \DB::beginTransaction();

        try {
            $petType = $this->repository->create($data);

            if ($translates && count($translates)) {
                foreach ($translates as $translate) {
                    $translate->row_id = $petType->id;
                    $this->translateService->create($translate);
                }
            }

            \DB::commit();

            $petType->refresh();
            $petType->searchable();
            return $petType;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка создания типа питомца", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'petTypeData'=>$data
            ]);
            throw new PetTypeCreateException($e->getMessage());
        }
    }

    /**
     * @throws \App\Exceptions\PetType\PetTypeDeleteException
     */
    public function delete(PetType $petType): void
    {
        \DB::beginTransaction();
        try {
            $this->deleteHandler->handle($petType);
            \DB::commit();
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка удаления типа питомца", [
                'userId' => auth()->user()->getAuthIdentifier(),
                'error' => $e->getMessage(),
                'petTypeId' => $petType->id
            ]);
            throw new PetTypeDeleteException($e->getMessage());
        }
    }

    /**
     * @throws PetTypeUpdateException
     */
    public function update(PetType $petType, PetTypeDTO $updateData): PetType
    {
        /** @var TranslateDTO[] $translates */
        $translates = $updateData->translates;
        $data = $updateData->all();

        \DB::beginTransaction();

        try {
            $result = $this->repository->update($petType, $data);
            if (!$result) {
                throw new PetTypeUpdateException();
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
            $petType->refresh();
            $petType->searchable();
            return $petType;
        } catch (\Throwable $e) {
            LogHelper::slack("Ошибка обновления типа питомца #{$petType->id}", [
                'userId'=>auth()->user()->getAuthIdentifier(),
                'error'=>$e->getMessage(),
                'petTypeData'=>$data
            ]);
            throw new PetTypeUpdateException($e->getMessage());
        }
    }
}