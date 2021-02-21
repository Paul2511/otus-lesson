<?php

namespace App\Services\Promotions\DTO;

class UpdatePromotionDTO {
    
    private string $text;
    private string $title;
    private string $validate;
    private int $status;
    
    public function __construct(
            string $text,
            string $title,
            string $validate,
            int $category_id,
            int $status
    ) {
        $this->text = $text;
        $this->title = $title;
        $this->status = $status;
        $this->category_id = $category_id;
        $this->validate = $validate;
    }
    public static function fromArray(array $data){
        return new static(
                $data['text'],
                $data['title'],
                $data['status'],
                $date['category_id'],
                $data['validate']
           );
    }


    public function toArray():array{
        return [
            'text' => $this->text,
            'title' => $this->title,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'validate' => $this->validate
            ];
    }
}
