<?php

namespace App\Services\Promotions\Handlers;

use \App\Services\Promotions\Repositories\EloquentPromotionsRepository;
use \App\Services\Promotions\DTO\CreateCategoryDTO;

class CreatePromotionHandler {
    
    private EloquentPromotionsRepository $eloquentPromotionsRepository;
    
    public function __construct(
        EloquentPromotionsRepository $eloquentPromotionsRepository
        ) {
        $this->eloquentPromotionsRepository = $eloquentPromotionsRepository;
    }
    
    public function handler(CreatePromotionDTO $createPromotionDTO):Category{
        $result = $this->eloquentPromotionsRepository->createFromArray($createPromotionDTO->toArray());
        $result = $this->eloquentPromotionsRepository->sendEmail($createPromotionDTO->toArray());
    }
}
