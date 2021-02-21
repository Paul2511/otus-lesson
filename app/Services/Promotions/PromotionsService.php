<?php

namespace App\Services\Promotions;

use App\Models\Promotion;
use App\Services\Promotions\DTO\CreatePromotionDTO;
use App\Services\Promotions\DTO\UpdatePromotionDTO;
use App\Services\Promotions\Handlers\UpdatePromotionHandler;
use App\Jobs\SendPromotionsEmail;

class PromotionsService {
    
    private UpdatePromotionHandler $updatePromotionHandler;
    
    public function __construct(
        UpdatePromotionHandler $updatePromotionHandler
    ) 
    {
        $this->updatePromotionHandler = $updatePromotionHandler;
    }
    
    public function createPromotion(CreatePromotionDTO $createPromotionDTO):Promotion{
        SendPromotionsEmail::dispatch($createPromotionDTO);
    }
    
    public function updatePromotion(UpdatePromotionDTO $updatePromotionDTO){
        $this->updatePromotionHandler->handler($updatePromotionDTO);
    }
}
