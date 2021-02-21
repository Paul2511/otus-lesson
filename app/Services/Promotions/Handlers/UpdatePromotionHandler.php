<?php

namespace App\Services\Promotions\Handlers;

use \App\Services\Promotions\Repositories\EloquentPromotionsRepository;
use \App\Services\Promotions\DTO\UpdatePromotionDTO;

class UpdatePromotionHandler {
    
    private EloquentPromotionsRepository $eloquentPromotionsRepository;
    
    public function __construct(
        EloquentPromotionsRepository $eloquentPromotionsRepository
    ) 
    {
        $this->eloquentPromotionsRepository = $eloquentPromotionsRepository;
    }
    
    public function handler(UpdatePromotionDTO $updatePromotionDTO){
        $this->eloquentPromotionsRepository->updateFromArray($updatePromotionDTO->toArray());
    }
}
