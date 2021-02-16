<?php

namespace App\Services\Promotions;

use App\Models\Promotion;
use App\Services\Promotions\DTO\CreatePromotionDTO;
use App\Services\Promotions\Handlers\CreatePromotionHandler;
use App\Jobs\SendPromotionsEmail;

class PromotionsService {
    
    private CreatePromotionHandler $createPromotionHandler;
    
    public function __construct(
            CreatePromotionHandler $createPromotionHandler
            ) {
        $this->createPromotionHandler = $createPromotionHandler;
    }
    
    public function createPromotion(CreatePromotionDTO $createPromotionDTO):Promotion{
        SendPromotionsEmail::dispatch($createPromotionDTO);
    }
    
    public function updatePromotion(UpdatePromotionDTO $updatePromotionDTO){
        $this->updatePromotionHandler->handler($updatePromotionDTO);
    }
}
