<?php

namespace App\Services\Promotions\Handlers;

use \App\Services\Promotions\Repositories\EloquentPromotionsRepository;
use \App\Services\Promotions\DTO\CreatePromotionDTO;

class CreatePromotionHandler {
    
    private EloquentPromotionsRepository $eloquentPromotionsRepository;
    
    public function __construct(
            EloquentPromotionsRepository $eloquentPromotionsRepository
        ) 
    {
        $this->eloquentPromotionsRepository = $eloquentPromotionsRepository;
    }
    
    public function handler(CreatePromotionDTO $createPromotionDTO)
    {
        $this->eloquentPromotionsRepository->createFromArray($createPromotionDTO->toArray());
        $this->eloquentPromotionsRepository->sendEmail($createPromotionDTO->toArray());
    }
}
